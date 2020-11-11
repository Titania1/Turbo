<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
	return [
		'name'    => $faker->name,
		'address' => $faker->address,
		'phone'   => $faker->regexify('/^(0)(5|6|7)(4|5|6|7)[0-9]{7}$/'),
		'credit'  => $faker->optional()->randomFloat(2, 1000, 10000),
	];
});
