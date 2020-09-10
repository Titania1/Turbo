<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VehicleModel;
use Faker\Generator as Faker;

$factory->define(VehicleModel::class, function (Faker $faker) {
	return [
		'name' => $faker->word,
	];
});
