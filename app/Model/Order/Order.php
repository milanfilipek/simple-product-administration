<?php

declare(strict_types=1);

namespace App\Model\Order;

use App\Model\Customer\Customer;
use Nextras\Orm\Entity\Entity;

/**
 * Order
 *
 * @property int                     $id            {primary}
 * @property Customer                $customer      {m:1 Customer::$orders}
 * @property string                  $orderNumber
 * @property float                   $totalPrice
 * @property string                  $status        {enum self::STATUS_*}
 * @property \DateTimeImmutable      $createdAt     {default now}
 * @property \DateTimeImmutable|null $updatedAt
 * @property OrderItem[]             $items         {1:m OrderItem::$order}

*/
final class Order extends Entity
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_SHIPPED = 'shipped';
}