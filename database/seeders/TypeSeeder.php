<?php

declare(strict_types=1);
namespace Database\Seeders;

use App\Type;
use App\Category;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Get the sub categories
		$categories = Category::where('category_id', '!=', null)->select('id')->limit(30)->pluck('id')->toArray();
		foreach ($categories as $category) {
			factory(Type::class, rand(4, 7))->create(['category_id' => $category]);
		}
	}
}
