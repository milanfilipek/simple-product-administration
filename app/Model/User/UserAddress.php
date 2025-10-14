<?php

declare(strict_types=1);

namespace App\Model\User;

use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\ManyHasOne;

/**
 * UserAddress
 *
 * @property int                     $id          {primary}
 * @property ManyHasOne<User>        $user        {m:1 User::$addresses}
 * @property string                  $type        {enum self::TYPE_*}
 * @property string                  $street
 * @property string                  $city
 * @property string                  $postalCode
 * @property string                  $country
 * @property \DateTimeImmutable      $createdAt   {default now}
 * @property \DateTimeImmutable|null $updatedAt
 */
final class UserAddress extends Entity
{
    public const TYPE_BILLING = 'billing';
    public const TYPE_SHIPPING = 'shipping';
}