<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Part;
use Faker\Generator as Faker;

$factory->define(Part::class, function (Faker $faker) {
    $price = $faker->randomFloat(2, 1000, 10000);

    return [
        'image' => 'parts/'.$faker->file(
            $sourceDir = 'data/parts',
            $targetDir = storage_path('/app/public/parts'),
            false
        ),
        'title'       => $faker->realText(20),
        'description' => $faker->realText(1600),
        'price'       => $price,
        'old_price'   => $price + ($price / rand(5, 10)), // TODO: make this optional
        'sku'         => $faker->optional()->swiftBicNumber,
        'rating'      => rand(0, 5),
    ];
});
