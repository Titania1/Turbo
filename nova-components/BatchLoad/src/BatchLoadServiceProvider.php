<?php

declare(strict_types=1);

namespace Emiliogrv\NovaBatchLoad;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BatchLoadServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->booted(function () {
			$this->routes();
		});

		Nova::serving(function (ServingNova $event) {
			Nova::script('batch-load-field', __DIR__ . '/../dist/js/field.js');
		});
	}

	/**
	 * Register the tool's routes.
	 *
	 * @return void
	 */
	protected function routes()
	{
		if ($this->app->routesAreCached()) {
			return;
		}

		Route::middleware(['nova'])
			->namespace('Emiliogrv\NovaBatchLoad\Http\Controllers')
			->prefix('nova-vendor/nova-batch-load')
			->group(__DIR__ . '/../routes/api.php');
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
