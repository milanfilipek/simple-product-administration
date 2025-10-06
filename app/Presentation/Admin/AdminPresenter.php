<?php

namespace App\Presentation\Admin;

use App\Forms\AuthFormFactory;
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
    // TODO: UserRepository
    #[Inject]
    public AuthFormFactory $authFormFactory;

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

    // TODO: Uživatelé (až bude UserRepository)
}