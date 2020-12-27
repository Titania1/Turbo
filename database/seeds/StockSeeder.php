<?php

declare(strict_types=1);

use App\{Part, Stock, User};
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::role('Member')->get();
		$parts = Part::all();
		foreach ($users as $user) {
			foreach ($parts as $part) {
				create(Stock::class, ['user_id' => $user->id, 'part_id' => $part->id]);
			}
		}
	}
}
