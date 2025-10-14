<?php

namespace App\Presentation\User;

use App\Forms\AuthFormFactory;
use App\Forms\Front\CustomerFormFactory;
use App\Model\Orm;
use App\Model\User\UserAddress;
use App\Model\User\UsersRepository;
use Nette\Application\UI\Presenter;

final class UserPresenter extends Presenter
{
    public function __construct(
        private readonly Orm $orm,
        public AuthFormFactory $authFormFactory,
        public CustomerFormFactory $customerFormFactory,
    ) {
        parent::__construct();
    }

    public function startup(): void
    {
        parent::startup();

        if ($this->getAction() !== 'logout') {
            if ($this->getUser()->isAllowed('Admin')) {
                $this->redirect('Admin:overview');
            } elseif ($this->getUser()->isAllowed('User')) {
                $this->redirect('User:profile');
            }
        }
    }

    public function renderLogin(): void
    {
    }

    public function renderProfile(): void
    {
    }

    public function renderEdit(): void
    {
        $customer = $this->orm->getRepository(UsersRepository::class)->findById($this->getUser()->getId());

        if (!$customer) {
            $this->error('Zákazník nenalezen.');
        }
    }

    protected function createComponentUserForm()
    {
        $customer = $this->orm->getRepository(UsersRepository::class)->findById($this->getUser()->getId());
        $billing = $customer?->getAddressByType('billing');
        $shipping = $customer?->getAddressByType('shipping');

        return $this->customerFormFactory->create($customer, $billing, $shipping);
    }

    protected function createComponentUserLoginForm()
    {
        return $this->authFormFactory->create();
    }

    public function actionLogout(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl jste úspěšně odhlášen.', 'success');
        $this->redirect('Home:default');
    }
}

