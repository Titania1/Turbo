<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, fn (Faker $faker) => [
	'avatar' => 'avatars/' . $faker->file(
		$sourceDir = 'data/avatars',
		$targetDir = storage_path('/app/public/avatars'),
		false
	),
	'address' => $faker->address,
	'phone' => $faker->regexify('/^(0)(5|6|7)(4|5|6|7)[0-9]{7}$/'),
]);
