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
 * @property string                  $firstName
 * @property string                  $lastName
 * @property string|null             $phone
 * @property bool                    $isActive    {default true}
 * @property \DateTimeImmutable      $createdAt    {default now}
 * @property \DateTimeImmutable|null $updatedAt
 * @property CustomerAddress[]       $addresses    {1:m CustomerAddress::$customer}
*/
final class Customer extends Entity
{
}

