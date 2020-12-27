<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;
use Faker\Provider\Fakecar;

$factory->define(Vehicle::class, function (Faker $faker) {
    $faker->addProvider(new Fakecar($faker));
    $v = $faker->vehicleArray();

    return [
        'from'        => $faker->biasedNumberBetween(1998, 2010, 'sqrt'),
        'to'          => $faker->biasedNumberBetween(2010, 2020, 'sqrt'),
        'name'        => $v['model'],
        'internal_id' => 1,
    ];
});
