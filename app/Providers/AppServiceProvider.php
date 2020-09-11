<?php

declare(strict_types=1);

namespace App\Providers;

use App\Nova\Templates\FooterOptions;
use App\Nova\Templates\HeaderOptions;
use Gloudemans\Shoppingcart\Facades\Cart;
use Whitecube\NovaPage\Pages\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 */
	public function boot(Manager $pages): void
	{
		// dd(Cart::content());
		Model::unguard();
		$pages->register('option', 'header', HeaderOptions::class);
		$pages->register('option', 'footer', FooterOptions::class);
		app('view')->addNamespace('mail', resource_path('views') . '/print');
	}
}
