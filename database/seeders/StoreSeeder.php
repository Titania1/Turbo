<?php

declare(strict_types=1);
namespace Database\Seeders;

use App\User;
use App\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::all();
		foreach ($users as $user) {
			$user->store()->create(
				create(Store::class, [], 'make')->toArray()
			);
		}
	}
}
