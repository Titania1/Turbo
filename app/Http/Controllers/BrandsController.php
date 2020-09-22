<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
		// Get vehicles of year
		$vehicles = Vehicle::where('year', $request->year)->select('brand_id')->distinct()->pluck('brand_id')->toArray();

		$brands = Brand::whereIn('id', $vehicles)->select('name', 'id')->get();

		return $brands;
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand, string $slug = null)
	{
		if ($slug != $brand->slug) {
			return redirect()->route('brand', [$brand->id, $brand->slug]);
		}
		$models = $brand->models()->paginate(21);
		return view('brand', compact('brand', 'models'));
	}
}
