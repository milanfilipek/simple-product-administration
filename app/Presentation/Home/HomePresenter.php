<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\Product\ProductsRepository;
use Nette;
use Nette\DI\Attributes\Inject;


final class HomePresenter extends Nette\Application\UI\Presenter
{
    #[Inject]
    private ProductsRepository $productsRepository;

    public function renderDefault(): void
    {
        $this->template->products = $this->productsRepository->findAll();
    }
}
