<?php

declare(strict_types=1);

namespace App\Model\Product;

use Nextras\Orm\Entity\Entity;

/**
 * @property int                  $id {primary}
 * @property string               $key
 * @property string               $value
 * @property Product              $product {m:1 Product::$productProperties}
 */
final class ProductProperty extends Entity
{
}