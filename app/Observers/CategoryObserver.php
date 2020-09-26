<?php

declare(strict_types=1);

namespace App\Observers;

use App\Category;

class CategoryObserver
{
	/**
	 * Handle the category "creating" event.
	 *
	 * @return void
	 */
	public function creating(Category $category)
	{
		$category->slug = sluggify($category->name);
	}

	/**
	 * Handle the category "created" event.
	 *
	 * @return void
	 */
	public function created(Category $category)
	{
		// Just app/public because the image attribute already includes 'categories' folder name
		// if ($category->image) {
		// 	$category->addMedia(storage_path('app/public/' . $category->image))
		// 		->preservingOriginal()
		// 		->toMediaCollection();
		// }
	}

	/**
	 * Handle the category "updating" event.
	 *
	 * @return void
	 */
	public function updating(Category $category)
	{
		if ($category->isDirty('name')) {
			$category->slug = sluggify($category->name);
		}
	}

	/**
	 * Handle the category "updated" event.
	 *
	 * @return void
	 */
	public function updated(Category $category)
	{
		// Just app/public because the image attribute already includes 'categories' folder name
		// if ($category->isDirty('image')) {
		// 	$category->addMedia(storage_path('app/public/' . $category->image))
		// 		->preservingOriginal()
		// 		->toMediaCollection();
		// }
	}

	/**
	 * Handle the category "deleted" event.
	 *
	 * @return void
	 */
	public function deleted(Category $category)
	{
		//
	}

	/**
	 * Handle the category "restored" event.
	 *
	 * @return void
	 */
	public function restored(Category $category)
	{
		//
	}

	/**
	 * Handle the category "force deleted" event.
	 *
	 * @return void
	 */
	public function forceDeleted(Category $category)
	{
		//
	}
}
