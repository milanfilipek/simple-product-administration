<?php

declare(strict_types=1);

namespace App\Model\Product;

use Nextras\Orm\Entity\Entity;

/**
 * Product
 *
 * @property int                     $id        {primary}
 * @property string                  $name
 * @property \DateTimeImmutable      $createdAt {default now}
 * @property \DateTimeImmutable|null $deletedAt
 * @property int                     $price
 * @property string                  $sku
 * @property int                     $ean
 * @property ProductProperty[]       $productProperties {1:m ProductProperty::$product}
 */
final class Product extends Entity
{
}