<?php

declare(strict_types=1);

namespace App\Presentation\Admin;

use Nette\Application\UI\Presenter;

final class AdminOverviewPresenter extends Presenter
{
    protected function startup(): void
    {
        parent::startup();

        $user = $this->getUser();
        if (!$user->isLoggedIn() || !$user->isInRole('admin')) {
            $this->flashMessage('Přístup pouze pro administrátory.', 'error');
            $this->redirect('Admin:default');
        }
    }
}
