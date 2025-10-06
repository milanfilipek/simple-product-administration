<?php

declare(strict_types=1);

namespace App\Model\Product;

use App\Model\Order\OrderItem;
use Nextras\Orm\Entity\Entity;

/**
 * Product
 *
 * @property int                        $id                 {primary}
 * @property string                     $name
 * @property \DateTimeImmutable         $createdAt          {default now}
 * @property \DateTimeImmutable|null    $deletedAt
 * @property int                        $price
 * @property string                     $sku
 * @property int                        $ean
 * @property ProductProperty[]          $productProperties  {1:m ProductProperty::$product}
 * @property OrderItem[]|null           $orderItems         {1:m OrderItem::$product}
 */
final class Product extends Entity
{
}