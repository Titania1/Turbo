<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
	public function parent()
	{
		return $this->belongsTo(self::class);
	}

	public function children()
	{
		return $this->hasMany(self::class);
	}

	public function getImageAttribute(): string
	{
		return secure_asset('storage/models/' . $this->id . '.jpg');
	}
}
