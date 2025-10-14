<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use Nette\SmartObject;

final class AuthFormFactory
{
    use SmartObject;

    public function __construct(
        private readonly User $user,
    ){
    }

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
                if ($form->getPresenter()?->getUser()->isAllowed('Admin')) {
                    $form->getPresenter()?->redirect('Admin:overview');
                } elseif ($form->getPresenter()?->getUser()->isAllowed('User')) {
                    $form->getPresenter()?->redirect('User:profile');
                } else {
                    $form->getPresenter()?->redirect('Home:default');
                }

            } catch (AuthenticationException $e) {
                $form->getPresenter()?->flashMessage('Neplatné přihlašovací údaje.', 'error');
            }
        };

        return $form;
    }
}