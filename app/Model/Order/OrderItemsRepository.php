<?php

declare(strict_types=1);

namespace App\Model\Order;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<OrderItem>
 */
final class OrderItemsRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [OrderItem::class];
    }
}