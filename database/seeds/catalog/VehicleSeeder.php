<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Model;
use App\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class VehicleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$models = Model::select('id', 'name')->get();
		foreach ($models as $model) {
			$this->seedVehiclesOfModel($model);
			break;
		}
	}

	private function seedVehiclesOfModel(Model $model): void
	{
		$vehicles = $this->getVehiclesByModel($model->name);
		foreach ($vehicles as $vehicle) {
			$this->create($vehicle, $model->id);
			break;
		}
	}

	private function getVehiclesByModel(string $name): Collection
	{
		return \DB::connection('tecdoc')
			->table('models')
			->select('id', 'From', 'To', 'Description')
			->where('Description', 'LIKE', $name . '%')
			->get();
	}

	private function create(object $vehicle, int $model_id): void
	{
		$to = ($vehicle->To == '0000-00-00') ? null : $vehicle->To;
		$from = ($vehicle->From == '0000-00-00') ? null : $vehicle->From;

		Vehicle::create([
			'internal_id' => $vehicle->id,
			'model_id' => $model_id,
			'from' => $from,
			'to' => $to,
			'name' => $vehicle->Description,
			'slug' => sluggify($vehicle->Description),
		]);
	}
}
