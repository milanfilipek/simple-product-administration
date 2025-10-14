<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Security\Authorizator as BaseAuthorizator;

class Authorizator implements BaseAuthorizator
{
    public function __construct(
        private readonly Nette\Database\Explorer $database,
    ) {
    }

    public function isAllowed($role, $resource, $privilege): bool
    {
        $roleRow = $this->database->table('roles')
            ->where('name', $role)
            ->fetch();

        if (!$roleRow) {
            return false;
        }

        $resourceRow = $this->database->table('resources')
            ->where('name', $resource)
            ->fetch();

        if (!$resourceRow) {
            return false;
        }

        if ($privilege === null) {
            $privilege = '*';
        }

        $permission = $this->database->table('permissions')
            ->where('role_id', $roleRow->id)
            ->where('resource_id', $resourceRow->id)
            ->whereOr([
                'privilege' => $privilege,
            ])
            ->fetch();

        return (bool) $permission;
    }
}
