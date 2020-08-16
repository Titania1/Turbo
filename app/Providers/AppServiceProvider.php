<?php

declare(strict_types=1);

namespace App\Providers;

use App\Nova\Templates\FooterOptions;
use App\Nova\Templates\HeaderOptions;
use Whitecube\NovaPage\Pages\Manager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(Manager $pages): void
	{
		$pages->register('option', 'header', HeaderOptions::class);
		$pages->register('option', 'footer', FooterOptions::class);
		app('view')->addNamespace('mail', resource_path('views') . '/print');
	}
}
