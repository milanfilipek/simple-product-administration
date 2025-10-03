<?php

namespace App\Presentation\Admin;

use App\Forms\ProductFormFactory;
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

    private ?Product $product = null;

    public function renderDefault(): void
    {
        $this->template->products = $this->orm->products->findAll();
    }

    public function renderEdit(int $id): void
    {
        $product = $this->orm->products->getById($id);
        if (!$product) {
            $this->error('Produkt nenalezen');
        }

        $this['productForm']->setDefaults([
            'name' => $product->name,
            'price' => $product->price,
        ]);

        $this->template->product = $product;
    }

    public function actionDelete(int $id): void
    {
        $product = $this->orm->products->getById($id);
        if ($product) {
            $this->orm->products->removeAndFlush($product);
            $this->flashMessage('Produkt byl smazán.', 'success');
        }
        $this->redirect('default');
    }

    protected function createComponentProductForm()
    {
        $id = $this->getParameter('id');
        $product = $id ? $this->orm->products->getById($id) : null;
        return $this->productFormFactory->create($product);
    }
}
