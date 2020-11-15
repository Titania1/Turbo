<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
	/**
	 * Show the form for editing the user's profile.
	 *
	 * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
	 *
	 * @return \Illuminate\View\View profile
	 */
	public function edit(): View
	{
		$user = auth()->user();
		$profile = $user->profile;
		if (!$profile) {
			Profile::withoutEvents(
				fn () => Profile::create([
					'user_id' => auth()->id(),
					'avatar'  => '/images/avatar.png',
					'locale'  => app()->getLocale(),
				])
			);
		}
		$profile = $user->profile;

		return view('profile', compact('profile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return \Illuminate\Http\RedirectResponse back
	 */
	public function update(UpdateProfileRequest $request, Profile $profile): RedirectResponse
	{
		$profile->update([
			'phone' => $request->phone,
		]);
		auth()->user()->name = $request->name;
		auth()->user()->email = $request->email;
		auth()->user()->save();

		return back()->with('status', __('Profile updated successfully!'));
	}
}
