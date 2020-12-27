<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
/**
 * App\Invoice.
 *
 * @property int                             $id
 * @property int                             $user_id
 * @property \Illuminate\Support\Carbon      $reception_date
 * @property int                             $supplier_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Part[] $parts
 * @property-read int|null $parts_count
 * @property-read \App\Supplier $supplier
 * @property-read \App\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereReceptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'reception_date' => 'date',
	];

	/**
	 * The relationships that should always be loaded.
	 *
	 * @var array
	 */
	protected $with = ['parts'];

	public function parts(): BelongsToMany
	{
		return $this->belongsToMany(Part::class);
	}

	public function supplier(): BelongsTo
	{
		return $this->belongsTo(Supplier::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
