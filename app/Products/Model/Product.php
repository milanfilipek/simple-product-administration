<?php

declare(strict_types=1);

namespace App\Products\Model;

use Nextras\Orm\Entity\Entity;

/**
 * Product
 *
 * @property int                     $id        {primary}
 * @property string                  $name
 * @property \DateTimeImmutable      $createdAt {default now}
 * @property \DateTimeImmutable|null $deletedAt
 * @property int                     $value
 */
class Product extends Entity
{
}