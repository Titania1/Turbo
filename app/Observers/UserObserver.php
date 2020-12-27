<?php

declare(strict_types=1);

namespace App\Observers;

use App\{Profile, User};
class UserObserver
{
	/**
	 * Handle the user "created" event.
	 *
	 * Create a profile for the newly created user.
	 *
	 *
	 * @return void
	 */
	public function created(User $user)
	{
		// Profile::create([
		// 	'user_id' => $user->id,
		// 	'avatar' => '/'
		// ]);
	}

	/**
	 * Handle the user "updating" event.
	 *
	 * @return void
	 */
	public function updating(User $user)
	{
		if ($user->isDirty('email')) {
			$user->email_verified_at = null;
		}
	}

	/**
	 * Handle the user "updated" event.
	 *
	 * @return void
	 */
	public function updated(User $user)
	{
		if ($user->isDirty('email')) {
			$user->sendEmailVerificationNotification();
		}
	}
}
