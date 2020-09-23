<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Receipt
 *
 * @property int $id
 * @property int $user_id
 * @property int $client_id
 * @property int|null $vat
 * @property int $display_vat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Client $client
 * @property-read float $subtotal
 * @property-read float $total
 * @property-read mixed $vat_value
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt query()
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereDisplayVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Receipt whereVat($value)
 * @mixin \Eloquent
 */
class Receipt extends Model
{
	public function parts()
	{
		return $this->belongsToMany(Part::class)
			->using(PartReceipt::class)->withPivot('quantity');
	}

	public function client()
	{
		return $this->belongsTo(Client::class);
	}

	public function getTotalAttribute(): float
	{
		return $this->subTotal + $this->vatValue;
	}

	public function getVatValueAttribute()
	{
		$value = $this->subTotal * $this->vat / 100;

		return number_format((float) $value, 2, '.', '');
	}

	// Total of receipt H.T without tax
	public function getSubtotalAttribute(): float
	{
		$price = 0;
		foreach ($this->parts as $part) {
			$price += ($part->price * (int) $part->pivot->quantity);
		}
		// Get the quantity of each part in the receipt
		return $price;
	}
}
