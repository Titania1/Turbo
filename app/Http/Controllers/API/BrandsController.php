<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Brand;
use App\Vehicle;
use Illuminate\Support\Collection;
use App\Http\Requests\YearsBrandRequest;

class BrandsController extends Controller
{
	/**
	 * Get Brands by year.
	 *
	 * Select brand names where year is passed year
	 *
	 * @param int \App\Http\Requests\YearsBrandRequest the year integer
	 * @return \Illuminate\Support\Collection $brands
	 **/
	public function getByYear(YearsBrandRequest $request): Collection
	{
		// Get model ids of year
		$models = Vehicle::where('from', $request->year)
			->select('model_id')->distinct()->pluck('model_id')->toArray();

		$brands = Brand::whereIn('id', $models)->select('name', 'id')->get();

		return $brands;
	}

	/**
	 * Return the specified brand
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand)
	{
		return response([
			'brand' => $brand,
		], 200);
	}
}

