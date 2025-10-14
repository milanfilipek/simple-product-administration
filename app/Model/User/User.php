<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Model\Order\Order;
use Nextras\Orm\Entity\Entity;
use Nextras\Orm\Relationships\OneHasMany;

/**
 * User
 *
 * @property int                                $id           {primary}
 * @property OneHasMany<UserAddress>            $orders       {1:m Order::$user, cascade="remove"}
 * @property string                             $email
 * @property string                             $username
 * @property string                             $password
 * @property string                             $firstName
 * @property string                             $lastName
 * @property string|null                        $phone
 * @property bool                               $isActive     {default true}
 * @property \DateTimeImmutable                 $createdAt    {default now}
 * @property \DateTimeImmutable|null            $updatedAt
 * @property OneHasMany<UserAddress>            $addresses    {1:m UserAddress::$user}
*/
final class User extends Entity
{
    public function getAddressByType(string $type): ?UserAddress
    {
        foreach ($this->addresses as $address) {
            if ($address->type === $type) {
                return $address;
            }
        }
        return null;
    }
}
