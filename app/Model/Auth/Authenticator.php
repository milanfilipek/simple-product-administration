<?php

declare(strict_types=1);

namespace App\Model\Auth;

use Nette;
use Nette\Security\Authenticator as BaseAuthenticator;
use Nette\Security\AuthenticationException;
use Nette\Security\SimpleIdentity;

class Authenticator implements BaseAuthenticator
{
    public function __construct(
        private Nette\Database\Explorer $database,
        private Nette\Security\Passwords $passwords,
    ) {
    }


    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $row = $this->database->table('users')
            ->where('username', $username)
            ->fetch();

        if (!$row) {
            throw new AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $row->id,
            $row->role,
            $row->toArray()
        );
    }
}