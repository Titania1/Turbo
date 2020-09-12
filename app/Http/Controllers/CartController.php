<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Part;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
	public function index()
	{
		$cart = Cart::content();

		return view('cart', compact('cart'));
	}

	public function add(Part $part, Request $request)
	{
		Cart::setGlobalTax(0);
		Cart::add($part);
		// request()->session()->flash('success', "$part->title added to cart!");

		Cart::add($part->id, $part->name, $part->quantity, $part->price)
			->associate('App\part');

		return back();
	}

	public function remove(string $rowId)
	{
		Cart::remove($rowId);

		return back();
	}

	public function update(request $request, $id)
	{
		Cart::update($id, $request->quantity);
		session()->flash('success_message', 'Quantity was updated successfully!');

		return response()->json(['success' => true]);
	}
}
