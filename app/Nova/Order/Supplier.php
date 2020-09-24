<?php

declare(strict_types=1);

namespace App\Nova\Order;

use App\Nova\Supplier as NovaSupplier;
use Laravel\Nova\Http\Requests\NovaRequest;

class Supplier extends NovaSupplier
{
	public static $displayInNavigation = false;

	/**
	 * Build an "index" query for the given resource.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	// public static function indexQuery(NovaRequest $request, $query)
	// {
	// 	return $query;
	// }
}
