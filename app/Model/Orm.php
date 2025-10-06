<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Customer\CustomersRepository;
use App\Model\Order\OrdersRepository;
use App\Model\Order\OrderItemsRepository;
use App\Model\Product\ProductPropertiesRepository;
use App\Model\Product\ProductsRepository;
use Nextras\Orm\Model\Model;


/**
 * Model
 *
 * @property-read ProductsRepository  $products
 * @property-read ProductPropertiesRepository $productProperties
 * @property-read OrdersRepository $orders
 * @property-read OrderItemsRepository $orderItems
 * @property-read CustomersRepository $customers
 */
class Orm extends Model
{
}