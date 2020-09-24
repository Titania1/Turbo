<?php

declare(strict_types=1);

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class BaseSeeder extends Seeder
{
	/**
	 * This is the base seeder
	 * It creates the necessary data to get started on the server
	 * Roles & Permissions for now.
	 *
	 * @return void
	 */
	public function run()
	{
		Artisan::call('admin:create');
		$this->call(RoleSeeder::class);
		$admin = User::first();
		$admin->assignRole('Super Admin');
	}
}
