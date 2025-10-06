<?php

declare(strict_types=1);

namespace App\Model\Customer;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Customer>
 */
final class CustomersRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [Customer::class];
    }
}

