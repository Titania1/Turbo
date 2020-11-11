<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'admin:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Admin User';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$user = User::create([
			'name'              => config('site.admin.name'),
			'email'             => config('site.admin.email'),
			'email_verified_at' => now(),
			'password'          => bcrypt('password'),
		]);
		$user->markEmailAsVerified();
	}
}
