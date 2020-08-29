<?php

declare(strict_types=1);

use App\Engine;
use App\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EngineSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		foreach ($this->getLocalModelIds() as $model) {
			foreach ($this->getTecDocCars((int) $model) as $car) {
				$this->createLocalEngine((int) $model, $car);
			}
		}
	}

	public function getLocalModelIds(): array
	{
		return VehicleModel::where('image', '!=', null)
			->select('image')
			->pluck('image')
			->toArray();
	}

	public function getTecDocCars(int $model_id): Collection
	{
		return DB::connection('tecdoc')
			->table('passengercars')
			->where('Model', $model_id)
			->select('Description', 'From', 'To', 'id')
			->get();
	}

	public function getEngineLink(int $car_id): int
	{
		return DB::connection('tecdoc')
			->table('passengercars_link_engines')
			->where('car_id', $car_id)
			->select('engine_id')
			->first()
			->engine_id;
	}

	public function getEngineInfo(int $car_id)
	{
		return DB::connection('tecdoc')
			->table('items_atributes')
			->where('item_id', $car_id)
			->where('IsPassengerCar', 1)
			->get();
	}

	public function createLocalEngine(int $model_id, object $car): void
	{
		$car_id = $car->id;
		$info = $this->getEngineInfo($car_id);
		Engine::create([
			'vehicle_model_id' => VehicleModel::where('image', $model_id)->first()->id,
			'type' => $car->Description,
			'interval' => $this->query($info, 'ConstructionInterval'),
			'power' => $this->query($info, 'Power'),
			'capacity' => $this->getCapacity($info),
			'cylinders' => $this->query($info, 'NumberOfCylinders'),
			'body_type' => $this->query($info, 'BodyType'),
			'fuel' => $this->query($info, 'FuelType'),
			'motor_code' => $this->query($info, 'EngineCode'),
		]);
	}

	public function query(Collection $info, string $col): string
	{
		$collection = $info->where('AttributeType', $col);
		if ($collection->count() > 1) {
			// Concatenate results into a single string
			$values = $info->where('AttributeType', $col)->pluck('DisplayValue')->ToArray();

			return implode(' - ', $values);
		}

		return $info->where('AttributeType', $col)->first()->DisplayValue;
	}

	public function getCapacity(Collection $info): string
	{
		$_1 = $this->query($info, 'Capacity_Technical'); // 1290 ccm
		$_1 = rtrim($_1, 'm'); // 1290 cc
		$_2 = $this->query($info, 'Capacity'); // 1,3 l
		$_2 = rtrim($_2, ' l'); // 1,3
		$_2 = number_format(str_replace(',', '.', $_2) * 100); // 130

		return $_1 . ' - ' . $_2 . ' L';
	}
}
