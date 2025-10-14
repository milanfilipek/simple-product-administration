<?php

namespace App\Presentation\Admin;

use App\Forms\Admin\UserFormFactory;
use App\Forms\Admin\ProductFormFactory;
use App\Forms\AuthFormFactory;
use App\Model\Orm;
use App\Model\User\UsersRepository;
use App\Model\Order\OrdersRepository;
use App\Model\Product\ProductsRepository;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class AdminPresenter extends Presenter
{
    #[Inject]
    public AuthFormFactory $authFormFactory;
    #[Inject]
    public ProductFormFactory $productFormFactory;
    #[Inject]
    public UserFormFactory $userFormFactory;

    public function __construct(
        private readonly Orm $orm,
    ) {
        parent::__construct();
    }

    public function actionDefault(): void
    {
        if ($this->getUser()->isAllowed('Admin')) {
            $this->redirect('Admin:overview');
        }
    }

    public function renderProducts(): void
    {
        $this->getTemplate()->products = $this->orm->getRepository(ProductsRepository::class)->findAll();
    }
    public function actionEditProduct(int $id): void
    {
        $product = $this->orm->getRepository(ProductsRepository::class)->findById($id);
        if (!$product) {
            $this->error('Produkt nebyl nalezen.');
        }
        $this->getTemplate()->product = $product;
    }

    protected function createComponentProductForm()
    {
        $productId = $this->getParameter('id');
        $product = $productId ? $this->orm->getRepository(ProductsRepository::class)->findById($productId) : null;

        return $this->productFormFactory->create($product);
    }


    public function handleDeleteProduct(int $id): void
    {
        $product = $this->orm->getRepository(ProductsRepository::class)->findById($id);
        if ($product) {
            $this->orm->removeAndFlush($product);
        }

        $this->flashMessage('Produkt byl smazán.', 'success');
        $this->redirect('Admin:products');
    }

    public function renderOrders(): void
    {
        $this->getTemplate()->orders = $this->orm->getRepository(OrdersRepository::class)->findAll();
    }
    public function actionEditOrder(int $id): void
    {
        $order = $this->orm->getRepository(OrdersRepository::class)->findById($id);
        if (!$order) {
            $this->error('Objednávka nebyla nalezena.');
        }

        $this->getTemplate()->order = $order;
    }
    public function handleDeleteOrder(int $id): void
    {
        $order = $this->orm->getRepository(OrdersRepository::class)->findById($id);
        if ($order) {
            $this->orm->removeAndFlush($order);
        }

        $this->flashMessage('Objednávka byla smazána.');
        $this->redirect('orders');
    }

    public function renderUsers(): void
    {
        $this->getTemplate()->users = $this->orm->getRepository(UsersRepository::class)->findAll();
    }

    public function actionEditUser(int $id): void
    {
        $user = $this->orm->getRepository(UsersRepository::class)->findById($id);
        if (!$user) {
            $this->error('Uživatel nebyl nalezen.');
        }
        $this->getTemplate()->user = $user;
    }

    public function handleDeleteUser(int $id): void
    {
        $user = $this->orm->getRepository(UsersRepository::class)->findById($id);
        if ($user) {
            $this->orm->removeAndFlush($user);
        }

        $this->flashMessage('Uživatel byl smazán.');
        $this->redirect('customers');
    }

    protected function createComponentUserForm()
    {
        $userId = $this->getParameter('id');
        $user = $userId ? $this->orm->getRepository(UsersRepository::class)->findById($userId) : null;

        return $this->userFormFactory->create($user);
    }
}