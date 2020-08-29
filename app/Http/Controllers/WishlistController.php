<?php

namespace App\Http\Controllers;

use App\Part;
use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
	public function index(Request $request)
	{

		$Wishlist = Wishlist::content();
		return view('whishlist', compact('Wishlist'));
	}


	public function add(Part $part)
	{

		Wishlist::add($part);
		request()->session()->flash('success', " $part->title added to Wishlist!");
		return back();
	}

	public function remove(string $rowId)
	{
		whishlist::remove($rowId);
		return back();
	}
}
