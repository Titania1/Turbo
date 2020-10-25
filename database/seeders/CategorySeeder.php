<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(Category::class, 7)->create();
		factory(Category::class, 5)
			->create()
			->each(fn ($category) => $category->categories()
				->createMany(factory(Category::class, rand(6, 11))->make()->toArray()));
	}
}
