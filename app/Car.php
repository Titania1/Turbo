<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	public function vehicle()
	{
		return $this->belongsTo(Vehicle::class);
	}

	public function engines()
	{
		return $this->belongsToMany(Engine::class);
	}
}
