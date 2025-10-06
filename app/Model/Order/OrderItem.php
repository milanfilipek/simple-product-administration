<?php

declare(strict_types=1);

namespace App\Model\Order;

use App\Model\Product\Product;
use Nextras\Orm\Entity\Entity;

/**
 * OrderItem
 *
 * @property int                $id          {primary}
 * @property Order              $order       {m:1 Order::$items}
 * @property Product            $product     {m:1 Product::$orderItems}
 * @property int                $quantity
 * @property float              $unitPrice
 * @property float              $totalPrice  {virtual}
 */
final class OrderItem extends Entity
{
    protected function getterTotalPrice(): float
    {
        return $this->quantity * $this->unitPrice;
    }
}
