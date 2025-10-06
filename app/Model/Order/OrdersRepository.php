<?php

declare(strict_types=1);

namespace App\Model\Order;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Order>
 */
final class OrdersRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [Order::class];
    }
}
