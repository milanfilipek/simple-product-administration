<?php

declare(strict_types=1);

namespace App\Model\User;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<UserAddress>
 */
final class UserAddressesRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [UserAddress::class];
    }
}
