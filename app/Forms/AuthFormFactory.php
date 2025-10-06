<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\Security\AuthenticationException;
use Nette\DI\Attributes\Inject;
use Nette\SmartObject;

final class AuthFormFactory
{
    use SmartObject;

    #[Inject]
    public User $user;

    public function create(): Form
    {
        $form = new Form;
        $form->addText('username')
            ->setRequired();
        $form->addPassword('password')
            ->setRequired();
        $form->addSubmit('send', 'Přihlásit se');

        $form->onSuccess[] = static function (Form $form, \stdClass $values) {
            try {
                $form->getPresenter()?->getUser()->login($values->username, $values->password);
                $form->getPresenter()?->flashMessage('Přihlášení proběhlo úspěšně.', 'success');
                $form->getPresenter()?->redirect('Admin:overview');
            } catch (AuthenticationException $e) {
                $form->getPresenter()?->flashMessage('Neplatné přihlašovací údaje.', 'error');
            }
        };

        return $form;
    }
}