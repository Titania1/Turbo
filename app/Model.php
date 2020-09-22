<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
	/**
	 * Get the value of the model's route key.
	 */
	public function getRouteKey()
	{
		return $this->id . '/' . $this->slug;
	}

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class);
	}
}
