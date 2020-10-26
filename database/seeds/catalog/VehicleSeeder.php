<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Model;
use App\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class VehicleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$models = Model::select('id', 'name', 'brand_id')->get();
		foreach ($models as $model) {
			$this->seedVehiclesOfModel($model);
		}
	}

	private function seedVehiclesOfModel(Model $model): void
	{
		$vehicles = $this->getVehiclesByModel($model);
		foreach ($vehicles as $vehicle) {
			$this->create($vehicle, $model->id);
		}
	}

	private function getVehiclesByModel(Model $model): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'From', 'To', 'Description')
			->where('ManufacturerId', $model->brand->internal_id)
			->where('CanBeDisplayed', 1)
			->where('Description', 'LIKE', $model->name . '%')
			->get();
	}

	private function create(object $vehicle, int $model_id): void
	{
		$to = ($vehicle->To == '0000-00-00') ? null : $vehicle->To;
		$from = ($vehicle->From == '0000-00-00') ? null : $vehicle->From;
		try {
			Vehicle::create([
				'internal_id' => $vehicle->id,
				'model_id' => $model_id,
				'from' => $from,
				'to' => $to,
				'name' => $vehicle->Description,
				'slug' => sluggify($vehicle->Description),
			]);
		} catch (QueryException $exception) {
			// Do nothing
		}
	}
}
