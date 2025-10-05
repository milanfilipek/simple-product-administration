<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use App\Model\Product\ProductsRepository;
use Nette;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;


final class ProductPresenter extends Presenter
{
    #[Inject]
    public ProductsRepository $productsRepository;

    public function actionDetail(int $id): void
    {
        $product = $this->productsRepository->getById($id);
        if (!$product) {
            $this->error('Produkt nebyl nalezen.');
        }
        $this->template->product = $product;
    }
}
