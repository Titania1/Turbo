<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, fn (Faker $faker) => [
    'name'  => $faker->words(rand(2, 3), true),
    'image' => 'categories/'.$faker->file(
        $sourceDir = 'data/departments',
        $targetDir = storage_path('/app/public/categories'),
        false
    ),
]);
