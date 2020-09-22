<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Engine;
use Faker\Provider\Fakecar;
use Faker\Generator as Faker;

$factory->define(Engine::class, function (Faker $faker) {
	$faker->addProvider(new Fakecar($faker));
	$v = $faker->vehicleArray();

	return [
		'fuel' => $faker->vehicleFuelType,
		'type' => $v['model'],
		'interval' => 'tmp',
		'power' => '68 pw',
		'capacity' => '89',
		'motor_code' => '1K0 DSJQL',
	];
});
