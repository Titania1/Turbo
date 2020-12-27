<?php

declare(strict_types=1);

namespace App\Policies;

use App\{Stock, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class StockPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any stocks.
	 */
	public function viewAny(User $user)
	{
		return $user->stocks;
	}

	/**
	 * Determine whether the user can view the stock.
	 */
	public function view(User $user, Stock $stock)
	{
		return $stock->user_id = $user->id;
	}

	/**
	 * Determine whether the user can create stocks.
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * Determine whether the user can update the stock.
	 */
	public function update(User $user, Stock $stock)
	{
		return true;
	}

	/**
	 * Determine whether the user can delete the stock.
	 */
	public function delete(User $user, Stock $stock)
	{
		return false;
	}

	/**
	 * Determine whether the user can restore the stock.
	 */
	public function restore(User $user, Stock $stock)
	{
		return true;
	}

	/**
	 * Determine whether the user can permanently delete the stock.
	 */
	public function forceDelete(User $user, Stock $stock)
	{
		return false;
	}
}
