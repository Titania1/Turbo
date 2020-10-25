<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\User;
use App\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Create the anonymous client
		// Client::create([
		// 	'user_id' => 1, // Should belong to the admin.
		// 	'name' => 'Anonymous',
		// ]);
		// Get all the ids of existing users
		$ids = User::select('id')->pluck('id');
		foreach ($ids as $id) {
			// Create 50 clients for each user
			factory(Client::class, 50)->create(['user_id' => $id]);
		}
	}
}
