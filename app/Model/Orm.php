<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Product\ProductPropertyRepository;
use App\Model\Product\ProductsRepository;
use Nextras\Orm\Model\Model;


/**
 * Model
 *
 * @property-read ProductsRepository  $products
 * @property-read ProductPropertyRepository $productProperty
 */
class Orm extends Model
{
}