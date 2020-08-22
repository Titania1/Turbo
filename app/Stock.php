<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
	/**
	 * Get the part that owns the stock.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo App\Part
	 */
	public function part(): BelongsTo
	{
		return $this->belongsTo(Part::class);
	}

	/**
	 * Get the user that owns the stock.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo App\User
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
