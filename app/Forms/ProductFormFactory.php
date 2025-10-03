<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use App\Model\Product\Product;
use App\Model\Orm;
use Nette\DI\Attributes\Inject;
use Nette\SmartObject;

final class ProductFormFactory
{
    use SmartObject;

    #[Inject]
    public Orm $orm;

    public function create(?Product $product = null): Form
    {
        $form = new Form;

        $form->addText('name', 'Název produktu')
            ->setRequired();

        $form->addText('price', 'Cena')
            ->setRequired()
            ->addRule(Form::FLOAT, 'Cena musí být číslo.');

        $form->addSubmit('save', 'Uložit');

        if ($product) {
            $form->setDefaults([
                'name' => $product->name,
                'price' => $product->price,
            ]);
        }

        $form->onSuccess[] = function (Form $form, \stdClass $values) use ($product) {
            if (!$product) {
                $product = new Product();
            }

            $product->name = $values->name;
            $product->price = (float) $values->price;

            $this->orm->products->persistAndFlush($product);

            $form->getPresenter()->flashMessage('Produkt byl uložen.', 'success');
            $form->getPresenter()->redirect('Admin:default');
        };

        return $form;
    }
}
