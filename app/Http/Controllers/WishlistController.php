<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\Wishlist;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class WishlistController extends Controller
{
	public function index(Request $request): View
	{
		dd(session('wishlist'));

		$wishlist = Wishlist::content();

		return view('wishlist', compact('wishlist'));
	}

	public function add(int $part_id): RedirectResponse
	{
		Wishlist::add($part_id);
		request()->session()->flash('success', __('Added to Wishlist!'));

		return back();
	}

	public function remove(int $part_id): RedirectResponse
	{
		Wishlist::remove($part_id);

		return back();
	}
}
