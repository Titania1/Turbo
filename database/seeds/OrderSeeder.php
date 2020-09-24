<?php

declare(strict_types=1);

use App\Part;
use App\User;
use App\Order;
use App\Supplier;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::select('id')->pluck('id')->toArray();
		$suppliers = Supplier::select('id')->pluck('id')->toArray();
		$parts = Part::select('id')->take(5)->pluck('id')->toArray();
		foreach ($users as $user) {
			foreach ($suppliers as $supplier) {
				factory(Order::class, 5)->create([
					'supplier_id' => $supplier,
					'user_id' => $user,
				])->each(fn ($order) => $order->attach($parts));
			}
		}
	}
}
