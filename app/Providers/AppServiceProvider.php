<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\WishlistFacade;
use Whitecube\NovaPage\Pages\Manager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Nova\Templates\{FooterOptions, HeaderOptions};

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		app()->bind('wishlist', fn () => new WishlistFacade());
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(Manager $pages): void
	{
		Model::unguard();
		$pages->register('option', 'header', HeaderOptions::class);
		$pages->register('option', 'footer', FooterOptions::class);
		app('view')->addNamespace('mail', resource_path('views').'/print');
	}
}
