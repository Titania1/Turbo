<?php

use App\Engine;
use Illuminate\Database\Seeder;

class CatalogCategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$engines = Engine::all();
		foreach ($engines as $engine) {
			//
		}
	}
}
