<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$admin = User::create([
			'name' => config('site.admin.name'),
			'email' => config('site.admin.email'),
			'email_verified_at' => now(),
			'password' => bcrypt('password'),
		]);
		$admin->assignRole('Super Admin');
		factory(User::class, 5)->create()->each(function ($user) {
			$user->assignRole('Member');
			factory(Profile::class)->create(['user_id' => $user->id]);
		});
		factory(User::class, 50)->create();
	}
}
