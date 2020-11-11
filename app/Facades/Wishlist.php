<?php

declare(strict_types=1);

namespace App\Facades;

class Wishlist
{
	public static function add(int $part_id): void
	{
		session()->push('wishlist.parts', $part_id);
	}

	public static function remove(int $part_id): void
	{
		session()->pop('wishlist.parts', $part_id);
	}

	public static function content(): array
	{
		return session('wishlist.parts', []);
	}
}
