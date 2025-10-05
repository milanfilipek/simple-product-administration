<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Product\ProductPropertiesRepository;
use App\Model\Product\ProductsRepository;
use Nextras\Orm\Model\Model;


/**
 * Model
 *
 * @property-read ProductsRepository  $products
 * @property-read ProductPropertiesRepository $productProperties
 */
class Orm extends Model
{
}