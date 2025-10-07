<?php

declare(strict_types=1);

namespace App\Model\Customer;

use Nextras\Orm\Entity\Entity;

/**
 * CustomerAddress
 *
 * @property int                     $id          {primary}
 * @property Customer                $customer    {m:1 Customer::$addresses}
 * @property string                  $type        {enum self::TYPE_*}
 * @property string                  $street
 * @property string                  $city
 * @property string                  $postalCode
 * @property string                  $country
 * @property \DateTimeImmutable      $createdAt   {default now}
 * @property \DateTimeImmutable|null $updatedAt
 */
final class CustomerAddress extends Entity
{
    public const TYPE_BILLING = 'billing';
    public const TYPE_SHIPPING = 'shipping';
}