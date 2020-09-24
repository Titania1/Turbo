<?php

declare(strict_types=1);

namespace App\Seeders;

use App\Engine;
use App\Vehicle;
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
		$vehicles = Vehicle::select('id', 'internal_id')->pluck('id', 'internal_id');
		foreach ($vehicles as $internal_id => $vehicle_id) {
			foreach ($this->getCars((int) $internal_id) as $car) {
				$this->createCarEngines((int) $vehicle_id, $car);
				break;
			}
			break;
		}
	}

	private function getCars(int $model_id): Collection
	{
		return DB::connection('tecdoc')
			->table('passengercars')
			->where('Model', $model_id)
			->select('Description', 'From', 'To', 'id')
			->get();
	}

	private function createCarEngines(int $vehicle_id, object $car): void
	{
		$car_id = $car->id;
		$engine_links = $this->getEnginesLinks($car_id);
		foreach ($engine_links as $engine_id) {
			$motor_code = DB::connection('tecdoc')
				->table('engines')
				->where('id', $engine_id)
				->select('Description', 'InternalID')
				->first()
				->Description;
			$info = $this->getEngineInfo($engine_id);
			Engine::create([
				'internal_id' => $engine_id,
				'vehicle_id' => $vehicle_id,
				'type' => $car->Description,
				'interval' => $this->query($info, 'ConstructionInterval'),
				'power' => $this->query($info, 'Power'),
				'capacity' => $this->query($info, 'Capacity'),
				'construction' => $this->query($info, 'EngineConstruction'),
				'fuel_mixture' => $this->query($info, 'FuelMixture'),
				'charge' => $this->query($info, 'ChargeType'),
				'cylinder_construction' => $this->query($info, 'CylinderConstruction'),
				'engine_management' => $this->query($info, 'EngineManagement'),
				'cooling_type' => $this->query($info, 'CoolingType'),
				'compression' => $this->query($info, 'Compression'),
				'torque' => $this->query($info, 'Torque'),
				'bore' => $this->query($info, 'Bore'),
				'stroke' => $this->query($info, 'Stroke'),
				'fuel' => $this->query($info, 'FuelType'),
				'bearings' => $this->query($info, 'NumberOfMainBearings'),
				'cylinders' => $this->query($info, 'NumberOfCylinders'),
				'valves' => $this->query($info, 'NumberOfValves'),
				'motor_code' => $motor_code,
			]);
			break;
		}
	}

	private function getEnginesLinks(int $car_id): array
	{
		return DB::connection('tecdoc')
			->table('passengercars_link_engines')
			->where('car_id', $car_id)
			->select('engine_id')
			->pluck('engine_id')
			->toArray();
	}

	private function getEngineInfo(int $engine_id)
	{
		return DB::connection('tecdoc')
			->table('items_atributes')
			->where('item_id', $engine_id)
			->where('IsEngine', 1)
			->get();
	}

	private function query(Collection $info, string $col)
	{
		$collection = $info->where('AttributeType', $col);
		if ($collection->count() > 1) {
			// Concatenate results into a single string
			// Handles the "Power" column because there are two values for it
			$values = $info->where('AttributeType', $col)->pluck('DisplayValue')->ToArray();

			return implode(' - ', $values);
		} elseif ($collection->count()) {
			return $info->where('AttributeType', $col)->first()->DisplayValue;
		}

		return null;
	}

	private function getCapacity(Collection $info): string
	{
		// We don't have capacity_technical in engines
		$_1 = $this->query($info, 'Capacity_Technical'); // 1290 ccm
		$_1 = rtrim($_1, 'm'); // 1290 cc
		$_2 = $this->query($info, 'Capacity'); // 1,3 l
		$_2 = rtrim($_2, ' l'); // 1,3
		$_2 = number_format(str_replace(',', '.', $_2) * 100); // 130

		return $_1 . ' - ' . $_2 . ' L';
	}
}
