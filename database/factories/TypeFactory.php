<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, fn (Faker $faker) => [
	'tree_id' => 1,
	'name' => $faker->unique()->word,
	'image' => 'types/' . $faker->file(
		$sourceDir = 'data/departments',
		$targetDir = storage_path('/app/public/types'),
		false
	),
]);
