<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware(['auth', 'verified']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$user = auth()->user();
		$profile = $user->profile;
		$orders = $user->orders()->latest()->take(3)->get();

		return view('dashboard', compact('user', 'profile', 'orders'));
	}
}
