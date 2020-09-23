<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailVerificationTest extends TestCase
{
	/** @test */
	public function an_user_can_verify_his_email_address()
	{
		$notification = new EmailVerificationNotification();

		$user = factory(User::class)->create(['email_verified_at' => null]);

		$uri = $notification->verificationUrl($user);

		$this->assertSame(null, $user->email_verified_at);

		$this->actingAs($user)->get($uri);

		$this->assertNotNull($user->email_verified_at);
	}
}
