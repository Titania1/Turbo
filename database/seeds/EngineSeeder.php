<?php

declare(strict_types=1);

use App\Engine;
use App\VehicleModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class EngineSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		foreach ($this->getLocalModelIds() as $model) {
			foreach ($this->getTecDocCars((int) $model) as $car) {
				$this->createLocalEngine((int) $model, $car);
				break;
			}
			break;
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

	public function getMotorCode(int $car_id): string
	{
		return DB::connection('tecdoc')
			->table('engines')
			->where('id', $this->getEngineLink($car_id))
			->select('Description')
			->first()
			->Description;
	}

	public function createLocalEngine(int $model_id, object $car): void
	{
		Engine::create([
			'vehicle_model_id' => $model_id,
			'type' => $car->Description,
			'from' => $car->From,
			'to' => $car->To,
			'motor_code' => $this->getMotorCode($car->id)
		]);
	}
}
