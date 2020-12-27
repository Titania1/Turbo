<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WishlistController extends Controller
{
	/**
	 * Wishlist index page.
	 *
	 * Returns the wishlist view with its content
	 *
	 * @param \Illuminate\Http\Request $request Request object
	 *
	 * @return \Illuminate\View\View wishlist
	 **/
	public function index(Request $request): View
	{
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
