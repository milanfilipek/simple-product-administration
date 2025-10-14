<?php

declare(strict_types=1);

namespace App\Model\Order;

use App\Model\User\Customer;
use App\Model\User\User;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasOne;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * Order
 *
 * @property int                        $id            {primary}
 * @property ManyHasOne<User>           $user          {m:1 User::$orders}
 * @property string                     $orderNumber
 * @property float                      $totalPrice
 * @property string                     $status        {enum self::STATUS_*}
 * @property \DateTimeImmutable         $createdAt     {default now}
 * @property \DateTimeImmutable|null    $updatedAt
 * @property OneHasMany<OrderItem>      $items         {1:m OrderItem::$order}

*/
final class Order extends Entity
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_SHIPPED = 'shipped';
}