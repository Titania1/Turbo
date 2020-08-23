<?php

declare(strict_types=1);

namespace App\Providers;

use App\Part;
use App\Brand;
use App\Category;
use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;

class ViewComposerServiceProvider extends ServiceProvider
{
	protected $defer = true;

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer(['layouts.header.navbar', 'partials.mobile_menu_links'], function ($view) {
			// Get parent categories which have sub categories
			$categories = Category::where('category_id', null)->whereHas('categories')->get();
			// Get parent categories which don't have subcategories
			$infertile_categories = Category::where('category_id', null)->whereDoesntHave('categories')->get();
			$view->with(['categories' => $categories, 'infertile_categories' => $infertile_categories]);
		});
		view()->composer(['partials.featured', 'partials.index.featured', 'partials.category_featured'], function ($view) {
			// Get 10 most popular (viewed) products
			$ids = \Illuminate\Support\Facades\Redis::zrevrange('popular_parts', 0, 9);
			$featured_parts = Part::whereIn('id', $ids)->with('media.model')->get();
			$view->with('featured_parts', $featured_parts);
		});
		view()->composer('partials.brands', function ($view) {
			// Get brands
			$brands = Brand::where('is_commercial', false)->get();
			$commercial_brands = Brand::where('is_commercial', true)->get();
			$view->with(['brands' => $brands, 'commercial_brands' => $commercial_brands]);
		});
		view()->composer('layouts.header.cart', fn ($view) => $view->with('cart', Cart::content()));
	}
}
