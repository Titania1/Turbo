<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'address' => $faker->optional()->address,
		'phone' => $faker->optional()->regexify('/^(0)(5|6|7)(4|5|6|7)[0-9]{7}$/'),
		'credit' => $faker->optional()->randomFloat(2, 1000, 10000),
	];
});
