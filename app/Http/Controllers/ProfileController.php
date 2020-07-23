<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Profile $profile)
	{
		//
	}

	/**
	 * Show the form for editing the user's profile.
	 *
	 * @return \Illuminate\View\View profile
	 */
	public function edit()
	{
		$profile = auth()->user()->profile()->firstOrCreate([
			'avatar' => '/images/avatar.png',
			'locale' => app()->getLocale(),
		]);

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

		return back()->with('status', 'Profile updated successfully!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Profile $profile)
	{
		//
	}
}
