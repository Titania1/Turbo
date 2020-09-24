<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StoreContact;
use Faker\Generator as Faker;

$factory->define(StoreContact::class, function (Faker $faker) {
	return [
		'longitude' => $faker->longitude,
		'latitude' => $faker->latitude,
		'address' => $faker->address,
		'phone' => $faker->regexify(''),
		'email' => $faker->email,
		'comment' => $faker->realText(120),
	];
});
