<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * Test users can register.
	 */

	/** @test */
	public function a_user_can_signup(): void
	{
		$fakeUser = factory(User::class)->make()->toArray();
		$user = $fakeUser;
		$user['password'] = 'password';
		$user['password_confirmation'] = 'password';
		$this->post('/register', $user);
		$fakeUser['email_verified_at'] = null;
		$this->assertDatabaseHas('users', $fakeUser);
	}
}
