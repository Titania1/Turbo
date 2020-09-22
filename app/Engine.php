<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
	public function vehicle()
	{
		return $this->belongsTo(Vehicle::class);
	}

	public function getRouteKeyName(): string
	{
		return 'slug';
	}
}
