<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\OrderPart.
 *
 * @property int $id
 * @property int $order_id
 * @property int $part_id
 * @property int $quantity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderPart whereQuantity($value)
 * @mixin \Eloquent
 */
class OrderPart extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
