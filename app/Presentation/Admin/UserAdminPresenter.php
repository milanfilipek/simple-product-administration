<?php

declare(strict_types=1);

namespace App\Presentation\Admin;

use Nette\Application\UI\Presenter;

final class UserAdminPresenter extends Presenter
{
    public function renderDefault(): void
    {
        $this->template->users = $this->userRepository->findAll();
    }

    public function actionEdit(int $id): void
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            $this->error('Uživatel nebyl nalezen.');
        }
        $this->template->user = $user;
    }

    public function handleDelete(int $id): void
    {
        $this->userRepository->deleteById($id);
        $this->flashMessage('Uživatel byl smazán.');
        $this->redirect('this');
    }
}

