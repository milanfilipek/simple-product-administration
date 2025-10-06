<?php

declare(strict_types=1);

namespace App\Presentation\Admin;

use App\Model\Order\OrdersRepository;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

final class OrderAdminPresenter extends Presenter
{
    #[Inject]
    public OrdersRepository $orderRepository;

    public function renderDefault(): void
    {
        $this->template->orders = $this->orderRepository->findAll();
    }

    public function actionEdit(int $id): void
    {
        $order = $this->orderRepository->findById($id);
        if (!$order) {
            $this->error('Objednávka nebyla nalezena.');
        }
        $this->template->order = $order;
    }

    public function handleDelete(int $id): void
    {
        $this->orderRepository->deleteById($id);
        $this->flashMessage('Objednávka byla smazána.');
        $this->redirect('this');
    }
}

