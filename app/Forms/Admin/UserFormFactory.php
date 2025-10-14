<?php

namespace App\Forms\Admin;

use App\Model\Orm;
use App\Model\User\User;
use Nette\Application\UI\Form;
use Nette\SmartObject;

class UserFormFactory
{
    use SmartObject;

    private Orm $orm;

    public function __construct(Orm $orm)
    {
        $this->orm = $orm;
    }

    public function create(?User $user = null): Form
    {
        $form = new Form;

        $form->addText('firstName', 'Jméno:')
            ->setRequired('Zadejte jméno.');

        $form->addText('lastName', 'Příjmení:')
            ->setRequired('Zadejte příjmení.');

        $form->addEmail('email', 'Email:')
            ->setRequired('Zadejte email.');

        $form->addPassword('password', 'Heslo:');

        $form->addCheckbox('isActive', 'Aktivní');

        $form->addSubmit('send', 'Uložit');

        if ($user) {
            $form->setDefaults([
                'firstName' => $user->getValue('firstName'),
                'lastName' => $user->getValue('lastName'),
                'email' => $user->getValue('email'),
                'isActive' => $user->getValue('isActive'),
            ]);
        }

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($user) {
            if (!$user) {
                $user = new User();
            }

            $user->setValue('firstName', $values->firstName);
            $user->setValue('lastName', $values->lastName);
            $user->setValue('email', $values->email);
            $user->setValue('phone', $values->phone);

            if (!empty($values->password)) {
                $user->setValue('password', password_hash($values->password, PASSWORD_DEFAULT));
            }
            $user->setValue('isActive', $values->isActive);

            $this->orm->persistAndFlush($user);

            $form->getPresenter()?->flashMessage('Zákazník byl uložen.', 'success');
            $form->getPresenter()?->redirect('Admin:users');
        };

        return $form;
    }
}

