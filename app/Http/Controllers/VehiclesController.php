<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Brand;
use App\Model;
use App\Engine;
use App\Vehicle;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\BrandModelsRequest;
use App\Http\Requests\ModelFuelOptionsRequest;

class VehiclesController extends Controller
{
	/**
	 * Get Brands by year.
	 *
	 * Select model names where brand is passed brand
	 *
	 * @param int \App\Http\Requests\BrandModelsRequest the brand id
	 * @return \Illuminate\Support\Collection $models
	 **/
	public function getModelsByBrand(BrandModelsRequest $request): Collection
	{
		$models = Model::where('brand_id', $request->brand)->select('name', 'id')->distinct()->orderBy('name')->get();

		return $models;
	}

	/**
	 * Get Fuel Options for model.
	 *
	 * Select fuel options where model is passed model
	 *
	 * @param string \App\Http\Requests\ModelFuelOptionsRequest the brand string
	 * @return \Illuminate\Support\Collection $brands
	 **/
	public function getFuelOptionsForModel(ModelFuelOptionsRequest $request): Collection
	{
		$fuels = Vehicle::where('model', $request->model)->select('fuel')->distinct()->pluck('fuel');

		return $fuels;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param \App\Brand $brand The Brand model or ID
	 * @param string $brand_slug The brand slug (optional)
	 * @param \App\Model $model The vehicles grouping model
	 * @param string|null $model_slug The model slug
	 * @param \App\Vehicle $vehicle The vehicle model or ID
	 * @param string|null $slug The vehicle slug
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Brand $brand, string $brand_slug = null, Model $model, string $model_slug = null, Vehicle $vehicle, string $slug = null)
	{
		if ($brand_slug != $brand->slug || $model_slug != $model->slug || $slug != $vehicle->slug) {
			return redirect()->route('vehicle', [
				$brand->id,
				$brand->slug,
				$model->id,
				$model->slug,
				$vehicle->id,
				$vehicle->slug,
			]);
		}
		$cars = $vehicle->cars()->get();

		return view('vehicle', compact('vehicle', 'cars'));
	}

	public function getVehiclesByModel(Request $request)
	{
		$vehicles = Vehicle::where('model_id', $request->model)->select('name', 'id')->get();

		return $vehicles;
	}

	public function getEnginesByVehicle(Request $request)
	{
		$engines = Engine::where('vehicle_id', $request->vehicle)->select('type', 'motor_code', 'id')->get();

		return $engines;
	}

	public function getCategoriesByEngine(Request $request)
	{
		$categories = Category::where('engine_id', $request->engine)
				->where('category_id', null)
				->select('name', 'id')->get();

		return $categories;
	}
}
