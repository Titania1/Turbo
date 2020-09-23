<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChangePasswordTest extends TestCase
{
	private object $user;

	public function setUp(): void
	{
		parent::setUp();
		$this->user = create(User::class);
		$this->login($this->user);
	}

	/**
	 * Test users can change their password.
	 */
	public function testPasswordChange(): void
	{
		$this->post('/password/confirm', ['password' => 'password']);
		$response = $this->post('/account/change-password', [
			'new_password' => 'New Password',
			'new_password_confirmation' => 'New Password',
		]);
		$response->assertRedirect('/');
		$response->assertSessionHas('message', __('Password has successfully been changed'));
	}

	/**
	 * Test users can confirm their password.
	 *
	 * Assert that sudo mode can be entered.
	 *
	 **/
	public function testUsersCanConfirmPassword(): void
	{
		$this->withoutExceptionHandling();
		$response = $this->post('/password/confirm', ['password' => 'password']);
		$response->assertRedirect('/dashboard');
		$response = $this->get('/account/password');
		$response->assertOk();
	}

	/**
	 * Test password confirmation middleware.
	 *
	 * Asserts a user is redirected to confirm their password,
	 * when attempting to access a route protected
	 * by the password confirmation middleware
	 *
	 **/
	public function testPasswordConfirmationRedirect(): void
	{
		$response = $this->get('/account/password');
		$response->assertRedirect('/password/confirm');
	}

	/**
	 * Test password confirmation route.
	 *
	 * Assert an OK status on /password/confirm route
	 *
	 **/
	public function test_password_confirmation_route(): void
	{
		$response = $this->get('/password/confirm');
		$response->assertOk();
	}
}
