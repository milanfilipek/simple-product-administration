<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\Orm;
use App\Model\Product\ProductsRepository;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
    public function __construct(
        private readonly Orm $orm,
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->getTemplate()->products = $this->orm->getRepository(ProductsRepository::class)->findAll();
    }
}
