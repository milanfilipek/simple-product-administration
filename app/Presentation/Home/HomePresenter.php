<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\Product\ProductsRepository;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;


final class HomePresenter extends Presenter
{
    #[Inject]
    public ProductsRepository $productsRepository;

    public function renderDefault(): void
    {
        $this->template->products = $this->productsRepository->findAll();
    }
}
