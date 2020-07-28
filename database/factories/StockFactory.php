<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, fn (Faker $faker) => [
		'quantity' => $faker->randomNumber(),
	]
);
