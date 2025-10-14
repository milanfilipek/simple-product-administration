<?php

declare(strict_types=1);

namespace App\Forms\Front;

use App\Model\Orm;
use App\Model\User\User;
use App\Model\User\UserAddress;
use App\Model\User\UsersRepository;
use Nette\Application\UI\Form;
use Nette\Forms\Form as FormAlias;
use Nette\Security\User as NetteUser;

class CustomerFormFactory
{
    public function __construct(
        private readonly NetteUser $netteUser,
        private readonly Orm $orm,
    ) {}

    public function create(?User $user = null, ?UserAddress $billingAddress = null, ?UserAddress $shippingAddress = null): Form
    {
        $form = new Form;

        $form->addGroup('Základní údaje');
        $form->addText('firstName', 'Jméno:')
            ->setRequired('Zadejte své jméno.');
        $form->addText('lastName', 'Příjmení:')
            ->setRequired('Zadejte své příjmení.');

        $form->addEmail('email', 'E-mail:')
            ->setRequired('Zadejte e-mail.');
        $form->addText('phone', 'Telefon:');

        $form->addGroup('Fakturační adresa');
        $form->addText('billing_street', 'Ulice:');
        $form->addText('billing_city', 'Město:');
        $form->addText('billing_zip', 'PSČ:');
        $form->addText('billing_country', 'Země:');


        $form->addGroup();
        $form->addCheckbox('different_shipping', 'Dodací adresa je odlišná')
            ->setDefaultValue(false)
            ->addCondition(FormAlias::Equal, true)
            ->toggle('shipping-fields');


        $form->addGroup('Dodací adresa')
            ->setOption('id', 'shipping-fields');

        $form->addText('shipping_street', 'Ulice:')
            ->addConditionOn($form['different_shipping'], FormAlias::Equal, true)
            ->setRequired(false);
        $form->addText('shipping_city', 'Město:')
            ->addConditionOn($form['different_shipping'], FormAlias::Equal, true)
            ->setRequired(false);
        $form->addText('shipping_zip', 'PSČ:')
            ->addConditionOn($form['different_shipping'], FormAlias::Equal, true)
            ->setRequired(false);
        $form->addText('shipping_country', 'Země:')
            ->addConditionOn($form['different_shipping'], FormAlias::Equal, true)
            ->setRequired(false);

        $form->onSuccess[] = function (Form $form, \stdClass $values): void {
            $this->processForm($form, $values);
        };

        if ($user) {
            $form->setDefaults([
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);
        }

        if ($billingAddress) {
            $form->setDefaults([
                'billing_street' => $billingAddress->street,
                'billing_city' => $billingAddress->city,
                'billing_zip' => $billingAddress->postalCode,
                'billing_country' => $billingAddress->country,
                'different_shipping' => $shippingAddress instanceof UserAddress,
            ]);
        }

        if ($shippingAddress) {
            $form->setDefaults([
                'shipping_street' => $shippingAddress->street,
                'shipping_city' => $shippingAddress->city,
                'shipping_zip' => $shippingAddress->postalCode,
                'shipping_country' => $shippingAddress->country,
            ]);
        }

        return $form;
    }

    private function processForm(Form $form, \stdClass $values): void
    {
        if (!$this->netteUser->isAllowed('User', 'edit')) {
            $form->getPresenter()?->flashMessage('Přístup odepřen.', 'error');
            return;
        }

        $customerId = $this->netteUser->getId();
        $user = $this->orm->getRepository(UsersRepository::class)->findById($customerId);

        if (!$user) {
            $form->getPresenter()?->flashMessage('Zákazník nebyl nalezen.', 'error');
            return;
        }

        $user->setValue('firstName', $values->firstName);
        $user->setValue('lastName', $values->lastName);
        $user->setValue('email', $values->email);
        $user->setValue('phone', $values->phone);

        $billing = $user->getAddressByType(UserAddress::TYPE_BILLING);

        if (!$billing) {
            $billing = new UserAddress();
            $billing->setValue('type', UserAddress::TYPE_BILLING);
            $billing->setValue('user', $user);

            $user->addresses->add($billing);
        }

        $billing->setValue('street', $values->billing_street);
        $billing->setValue('city', $values->billing_city);
        $billing->setValue('postalCode', $values->billing_zip);
        $billing->setValue('country', $values->billing_country);

        if ($values->different_shipping) {
            $shipping = $user->getAddressByType(UserAddress::TYPE_SHIPPING);

            if (!$shipping) {
                $shipping = new UserAddress();
                $shipping->setValue('type', UserAddress::TYPE_SHIPPING);
                $shipping->setValue('user', $user);

                $user->addresses->add($shipping);
            }

            $shipping->setValue('street', $values->shipping_street);
            $shipping->setValue('city', $values->shipping_city);
            $shipping->setValue('postalCode', $values->shipping_zip);
            $shipping->setValue('country', $values->shipping_country);
        } else {
            $shipping = $user->getAddressByType(UserAddress::TYPE_SHIPPING);
            if ($shipping) {
                $user->addresses->remove($shipping);
            }
        }

        $this->orm->persistAndFlush($user);

        $form->getPresenter()?->flashMessage('Údaje byly úspěšně uloženy.', 'success');
        $form->getPresenter()?->redirect('User:profile');
    }
}
