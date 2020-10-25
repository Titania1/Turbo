<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\User;
use App\Garage;
use Illuminate\Database\Seeder;

class GarageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::select('id')->pluck('id')->toArray();
		foreach ($users as $user_id) {
			// Should probably use a factory, dunno what other fields
			// we need, let's check in the view
			Garage::create(['user_id' => $user_id]);
		}
	}
}
