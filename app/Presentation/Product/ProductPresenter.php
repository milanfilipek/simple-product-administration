<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use App\Model\Orm;
use App\Model\Product\ProductsRepository;
use Nette;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;


final class ProductPresenter extends Presenter
{
    public function __construct(
        private readonly Orm $orm,
    ) {
        parent::__construct();
    }

    public function actionDetail(int $id): void
    {
        $product = $this->orm->getRepository(ProductsRepository::class)->getById($id);
        if (!$product) {
            $this->error('Produkt nebyl nalezen.');
        }

        $this->getTemplate()->product = $product;
    }
}
