<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'from' => 'date',
		'to' => 'date',
	];

	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function parent()
	{
		return $this->belongsTo(self::class);
	}

	public function children()
	{
		return $this->hasMany(self::class);
	}

	public function getPictureAttribute(): string
	{
		return secure_asset('storage/models/' . $this->image . '.jpg');
	}

	public function getLifeSpanAttribute(): string
	{
		$from = $this->from->format('m.Y');
		$to = ($this->to) ? $this->to->format('m.Y') : __('today');

		return "($from " . __('to') . " $to)";
	}
}
