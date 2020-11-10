<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Car;
use App\Vehicle;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = Vehicle::select('id', 'internal_id')->pluck('id', 'internal_id');
        foreach ($vehicles as $internal_id => $vehicle_id) {
            $cars = $this->getCars($internal_id);
            foreach ($cars as $car) {
                $to = ($car->To == '0000-00-00') ? null : $car->To;
                $from = ($car->From == '0000-00-00') ? null : $car->From;

                try {
                    Car::create([
                        'internal_id' => $car->id,
                        'vehicle_id'  => $vehicle_id,
                        'type'        => $car->Description,
                        'from'        => $from,
                        'to'          => $to,
                        'slug'        => sluggify($car->Description),
                    ]);
                } catch (Exception $exception) {
                    // It's a duplicate
                }
            }
        }
    }

    private function getCars(int $model_id): Collection
    {
        return DB::connection('tecdoc')
            ->table('passengercars')
            ->where('Model', $model_id)
            ->where('CanBeDisplayed', 1)
            ->select('id', 'From', 'To', 'Description')
            ->get();
    }
}
