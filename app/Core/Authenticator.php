<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator as BaseAuthenticator;
use Nette\Security\IdentityHandler;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;

class Authenticator implements BaseAuthenticator, IdentityHandler
{
    public function __construct(
        private Nette\Database\Explorer $database,
        private Nette\Security\Passwords $passwords,
    ) {
    }


    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $userRow = $this->database->table('users')
            ->where('username', $username)
            ->fetch();

        if (!$userRow) {
            throw new AuthenticationException('User not found.');
        }

        if (!$userRow->is_active) {
            throw new AuthenticationException('User is not active.');
        }

        if (!$this->passwords->verify($password, $userRow->password)) {
            throw new AuthenticationException('Invalid password.');
        }

        $roleRows = $this->database->table('users_roles')
            ->where('user_id', $userRow->id)
            ->fetchAll();

        $roles = [];
        foreach ($roleRows as $roleRow) {
            $role = $this->database->table('roles')->get($roleRow->role_id);
            if ($role) {
                $roles[] = $role->name;
            }
        }

        return new SimpleIdentity(
            $userRow->id,
            $roles,
            [
                'email' => $userRow->email,
                'username' => $userRow->username,
                'first_name' => $userRow->first_name,
                'last_name' => $userRow->last_name,
                'phone' => $userRow->phone,
            ]
        );
    }

    public function sleepIdentity(IIdentity $identity): IIdentity
    {
        return $identity;
    }

    /**
     * @throws AuthenticationException
     */
    public function wakeupIdentity(IIdentity $identity): ?IIdentity
    {
        $userRow = $this->database->table('users')
            ->where('id', $identity->getId())
            ->fetch();

        if (!$userRow) {
            throw new AuthenticationException('User not found.');
        }

        if (!$userRow->is_active) {
            throw new AuthenticationException('User is not active.');
        }

        return new SimpleIdentity(
            $identity->getId(),
            $identity->getRoles(),
            [
                'email' => $userRow->email,
                'username' => $userRow->username,
                'first_name' => $userRow->first_name,
                'last_name' => $userRow->last_name,
                'phone' => $userRow->phone,
            ]
        );
    }
}