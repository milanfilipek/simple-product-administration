<?php

namespace App\Presentation\User;

use Nette\Application\UI\Presenter;

final class UserPresenter extends Presenter
{
    public function actionLogout(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl jste úspěšně odhlášen.', 'success');
        $this->redirect('Home:default');
    }
}

