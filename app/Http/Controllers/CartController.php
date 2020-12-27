<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Part;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
	public function index(): View
	{
		$cart = Cart::content();

		return view('cart', compact('cart'));
	}

	public function add(Part $part, Request $request): RedirectResponse
	{
		Cart::setGlobalTax(0);
		Cart::add($part, $request->quantity);
		if ($request->wantsJson()) {
			return response([
				'message' => __('Part added'),
			], 200);
		}
		request()->session()->flash('success', "$part->name added to cart!");

		return redirect(url()->previous('/'));
	}

	public function remove(string $rowId): RedirectResponse
	{
		Cart::remove($rowId);

		return back();
	}

	public function update(request $request, $id): RedirectResponse
	{
		Cart::update($id, $request->qty);
		session()->flash('success_message', 'Quantity was updated successfully!');

		return back();
	}

	/**
	 * Get cart item quantity.
	 *
	 * Return the quantity of a cart item by model id
	 *
	 * @param int $id Model ID
	 *
	 * @throws NotFoundHttpException
	 *
	 * @return int $qty
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
