<?php

declare(strict_types=1);

namespace App\Observers;

use App\Part;

class PartObserver
{
	/**
	 * Handle the part "creation" event.
	 */
	public function creating(Part $part): void
	{
		$part->slug = sluggify($part->title);
		$part->excerpt = str_limit($part->description, 200);
		if (!$part->user_id && auth()->check()) {
			$part->user_id = auth()->id();
		}
		$part->price = preg_replace('/[^0-9]/', '', $part->price);
	}

	/**
	 * Handle the part "created" event.
	 */
	public function created(Part $part): void
	{
		// Just app/public because the image attribute already includes 'parts' folder name
		if ($part->image) {
			$part->addMedia(storage_path('app/public/' . $part->image))
				->preservingOriginal()
				->toMediaCollection();
		}
		if (auth()->check()) {
			auth()->user()->stocks()->create(['part_id' => $part->id, 'quantity' => 0]);
		}
	}

	/**
	 * Handle the part "updating" event.
	 */
	public function updating(Part $part): void
	{
		if ($part->isDirty('price')) {
			$part->old_price = $part->getOriginal('price');
		}
		if ($part->isDirty('title')) {
			$part->slug = sluggify($part->title);
		}
		if ($part->isDirty('description')) {
			$part->excerpt = str_limit($part->description, 200);
		}
	}

	/**
	 * Handle the part "updated" event.
	 */
	public function updated(Part $part): void
	{
		// Just app/public because the image attribute already includes 'parts' folder name
		if ($part->isDirty('image')) {
			$part->addMedia(storage_path('app/public/' . $part->image))
				->preservingOriginal()
				->toMediaCollection();
		}
	}
}
