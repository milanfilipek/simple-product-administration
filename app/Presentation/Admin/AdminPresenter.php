<?php

namespace App\Presentation\Admin;

use App\Forms\ProductFormFactory;
use App\Forms\AuthFormFactory;
use App\Model\Product\Product;
use Nette\Application\UI\Presenter;
use App\Model\Orm;
use Nette\DI\Attributes\Inject;

final class AdminPresenter extends Presenter
{
    #[Inject]
    public Orm $orm;

    #[Inject]
    public ProductFormFactory $productFormFactory;

    #[Inject]
    public AuthFormFactory $authFormFactory;

    private ?Product $product = null;

    public function renderDefault(): void
    {
        $this->template->products = $this->orm->products->findAll();
    }

    protected function createComponentProductForm()
    {
        $id = $this->getParameter('id');
        $product = $id ? $this->orm->products->getById($id) : null;
        return $this->productFormFactory->create($product);
    }

    protected function createComponentLoginForm()
    {
        return $this->authFormFactory->create();
    }
}