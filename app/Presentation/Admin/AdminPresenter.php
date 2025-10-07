<?php

namespace App\Presentation\Admin;

use App\Forms\AuthFormFactory;
use App\Model\Customer\CustomersRepository;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;
use App\Model\Product\ProductsRepository;
use App\Model\Order\OrdersRepository;

final class AdminPresenter extends Presenter
{
    #[Inject]
    public ProductsRepository $productRepository;
    #[Inject]
    public OrdersRepository $orderRepository;
    #[Inject]
    public AuthFormFactory $authFormFactory;
    #[Inject]
    public CustomersRepository $customersRepository;

    public function actionDefault(): void
    {
        if ($this->getUser()->isLoggedIn() || $this->getUser()->isInRole('admin')) {
            $this->redirect('Admin:overview');
        }
    }

    protected function createComponentLoginForm()
    {
        return $this->authFormFactory->create();
    }

    // Produkty
    public function renderProducts(): void
    {
        $this->template->products = $this->productRepository->findAll();
    }
    public function actionEditProduct(int $id): void
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            $this->error('Produkt nebyl nalezen.');
        }
        $this->template->product = $product;
    }
    public function handleDeleteProduct(int $id): void
    {
        $this->productRepository->deleteById($id);
        $this->flashMessage('Produkt byl smazán.');
        $this->redirect('products');
    }

    // Objednávky
    public function renderOrders(): void
    {
        $this->template->orders = $this->orderRepository->findAll();
    }
    public function actionEditOrder(int $id): void
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            $this->error('Objednávka nebyla nalezena.');
        }
        $this->template->order = $order;
    }
    public function handleDeleteOrder(int $id): void
    {
        $this->orderRepository->deleteById($id);
        $this->flashMessage('Objednávka byla smazána.');
        $this->redirect('orders');
    }

    public function renderUsers(): void
    {
        $this->template->users = $this->customersRepository->findAll();
    }

    public function actionEditUser(int $id): void
    {
        $user = $this->customersRepository->findById($id);
        if (!$user) {
            $this->error('Uživatel nebyl nalezen.');
        }
        $this->template->user = $user;
    }

    public function handleDeleteUser(int $id): void
    {
        $this->customersRepository->deleteById($id);
        $this->flashMessage('Uživatel byl smazán.');
        $this->redirect('users');
    }
}