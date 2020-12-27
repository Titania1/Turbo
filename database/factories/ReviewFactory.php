<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\{Review, User};
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
	$user_ids = User::inRandomOrder()->select('id')->limit(1)->pluck('id')->toArray();

	return [
		'user_id' => $faker->randomElement($user_ids),
		'name'    => $faker->name,
		'content' => $faker->text,
		'rating'  => rand(0, 5),
	];
});
