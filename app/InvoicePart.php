<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\InvoicePart.
 *
 * @property int   $id
 * @property int   $part_id
 * @property int   $invoice_id
 * @property int   $quantity
 * @property float $buy_price
 * @property float $sell_price
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart whereBuyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvoicePart whereSellPrice($value)
 * @mixin \Eloquent
 */
class InvoicePart extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'invoice_part';
}
