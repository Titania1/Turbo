<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\PartReceipt.
 *
 * @property int $id
 * @property int $part_id
 * @property int $receipt_id
 * @property int $quantity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartReceipt whereReceiptId($value)
 * @mixin \Eloquent
 */
class PartReceipt extends Pivot
{
	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = true;
}
