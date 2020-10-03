<?php

namespace App\Seeders;

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$products = $this->getCatalogProducts();
		foreach ($products as $product) {
			Product::create(['name' => $product->Description]);
		}
	}

	private function getCatalogProducts(): Collection
	{
		return DB::connection('tecdoc')
			->table('products')
			->select('Description')
			->distinct('Description')
			->get();
	}
}
