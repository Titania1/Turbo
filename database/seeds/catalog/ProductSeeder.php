<?php

declare(strict_types=1);

namespace App\Seeders\Catalog;

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$products = $this->getCatalogProducts();
		foreach ($products as $product) {
			Product::create(['name' => $product->Description]);
		}
	}

	/**
	 * Get catalog products.
	 *
	 * Undocumented function long description
	 *
	 * @return type
	 * @throws conditon
	 **/
	private function getCatalogProducts(): Collection
	{
		return DB::connection('tecdoc')
			->table('products')
			->select('Description')
			->distinct('Description')
			->get();
	}
}
