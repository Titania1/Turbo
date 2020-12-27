<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Engine;
use Faker\Provider\Fakecar;
use Faker\Generator as Faker;

$factory->define(Engine::class, function (Faker $faker) {
	$faker->addProvider(new Fakecar($faker));

	return [
		'fuel'        => $faker->vehicleFuelType,
		'interval'    => 'tmp',
		'power'       => '68 pw',
		'capacity'    => '89',
		'motor_code'  => '1K0 DSJQL',
		'internal_id' => 1,
	];
});
