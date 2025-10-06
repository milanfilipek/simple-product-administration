<?php

declare(strict_types=1);

namespace App\Model\Customer;

use App\Model\Order\Order;
use Nextras\Orm\Entity\Entity;

/**
 * Customer
 *
 * @property int                     $id           {primary}
 * @property Order[]|null            $orders       {1:m Order::$customer, cascade="remove"}
 * @property string                  $email
 * @property string                  $name
 * @property string|null             $address
 * @property string|null             $phone
 * @property \DateTimeImmutable      $createdAt    {default now}
 * @property \DateTimeImmutable|null $updatedAt
 */
final class Customer extends Entity
{
}

