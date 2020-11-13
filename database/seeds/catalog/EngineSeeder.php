<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Brand;
use App\Engine;
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
		$brands = Brand::select('id', 'internal_id')->get();
		foreach ($brands as $brand) {
			$engines = $this->getBrandEngines($brand->internal_id);
			foreach ($engines as $engine) {
				$info = $this->getEngineInfo($engine->id);
				Engine::create([
					'brand_id'              => $brand->id,
					'internal_id'           => $engine->id,
					'motor_code'            => $engine->Description,
					'interval'              => $this->query($info, 'ConstructionInterval'),
					'power'                 => $this->query($info, 'Power'),
					'capacity'              => $this->query($info, 'Capacity'),
					'construction'          => $this->query($info, 'EngineConstruction'),
					'fuel_mixture'          => $this->query($info, 'FuelMixture'),
					'charge'                => $this->query($info, 'ChargeType'),
					'cylinder_construction' => $this->query($info, 'CylinderConstruction'),
					'engine_management'     => $this->query($info, 'EngineManagement'),
					'cooling_type'          => $this->query($info, 'CoolingType'),
					'compression'           => $this->query($info, 'Compression'),
					'torque'                => $this->query($info, 'Torque'),
					'bore'                  => $this->query($info, 'Bore'),
					'stroke'                => $this->query($info, 'Stroke'),
					'fuel'                  => $this->query($info, 'FuelType'),
					'bearings'              => $this->query($info, 'NumberOfMainBearings'),
					'cylinders'             => $this->query($info, 'NumberOfCylinders'),
					'valves'                => $this->query($info, 'NumberOfValves'),
					'slug'                  => sluggify($engine->Description),
				]);
			}
		}
	}

	private function getBrandEngines(int $internal_id): Collection
	{
		return DB::connection('tecdoc')
			->table('engines')
			->where('manufacturer', $internal_id)
			->where('CanBeDisplayed', 1)
			// Description is the motor_code
			// From & To are 0000-00-00, so we don't select them
			->select('Description', 'id')
			->get();
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
}
