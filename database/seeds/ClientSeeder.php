<?php

declare(strict_types=1);

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
		Client::create([
			'user_id' => 1,
			'name' => 'Anonymous'
		]);
		$ids = User::select('id')->pluck('id');
		foreach ($ids as $id) {
			factory(Client::class, 50)->create(['user_id' => $id]);
		}
	}
}
