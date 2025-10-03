<?php

declare(strict_types=1);

namespace App\Model\Product;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<ProductProperty>
 */
final class ProductPropertyRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [ProductProperty::class];
    }
}