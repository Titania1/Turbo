<?php

declare(strict_types=1);

use App\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(Discount::class, 10)->create();
	}
}
