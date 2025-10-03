<?php

declare(strict_types=1);

namespace App\Model\Product;

use Nextras\Orm\Repository\Repository;

/**
 * @extends Repository<Product>
 */
class ProductsRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [Product::class];
    }
}