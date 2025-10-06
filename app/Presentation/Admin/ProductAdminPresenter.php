<?php

declare(strict_types=1);

namespace App\Presentation\Admin;

use App\Model\Product\ProductsRepository;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class ProductAdminPresenter extends Presenter
{
    #[Inject]
    public ProductsRepository $productRepository;

    public function renderDefault(): void
    {
        $this->template->products = $this->productRepository->findAll();
    }

    public function actionEdit(int $id): void
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            $this->error('Produkt nebyl nalezen.');
        }
        $this->template->product = $product;
    }

    public function handleDelete(int $id): void
    {
        $this->productRepository->deleteById($id);
        $this->flashMessage('Produkt byl smazán.');
        $this->redirect('this');
    }
}

