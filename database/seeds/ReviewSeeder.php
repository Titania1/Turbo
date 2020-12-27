<?php

declare(strict_types=1);

use App\{Part, Review};
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$parts = Part::all();
		foreach ($parts as $part) {
			$part->reviews()->createMany(
				factory(Review::class, rand(3, 15))->make(['user_id' => null])->toArray()
			);
			$part->reviews()->createMany(
				factory(Review::class, rand(3, 15))->make()->toArray()
			);
		}
	}
}
