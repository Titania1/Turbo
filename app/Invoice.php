<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
