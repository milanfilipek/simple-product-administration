<?php

declare(strict_types=1);

namespace App\Model\Customer;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<CustomerAddress>
 */
final class CustomerAddressesRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [CustomerAddress::class];
    }
}
