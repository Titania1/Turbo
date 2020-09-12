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
		Cart::add($part, $request->quantity);
		//request()->session()->flash('success', "$part->name added to cart!");
		return redirect(url()->previous('/'));
	}

	public function remove(string $rowId)
	{
		Cart::remove($rowId);

		return back();
	}

	public function update(request $request, $id)
	{
		Cart::update($id, $request->qty);
		//session()->flash('success_message', 'Quantity was updated successfully!');
		return back();
	}

	/**
	 * Get cart item quantity.
	 *
	 * Return the quantity of a cart item by model id
	 *
	 * @param int $id Model ID
	 * @return int $qty
	 * @throws NotFoundHttpException
	 **/
	public function getQuantity(int $id): int
	{
		if (request()->wantsJson()) {
			$cart = Cart::content();
			$item = $cart->where('id', $id)->first();

			return $item ? (int) $item->qty : 0;
		}

		return abort(404);
	}
}
