<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * The path to the "home" route for your application.
	 *
	 * @var string
	 */
	public const HOME = '/dashboard';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		// Route::bind('brand', function ($value) {
		// 	return App\Models\User::where('name', $value)->firstOrFail();
		// });

		parent::boot();
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map()
	{
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		if (!app()->isProduction()) {
			$this->mapDevRoutes();
		}
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes()
	{
		Route::middleware('web')
			->namespace($this->namespace)
			->group(base_path('routes/web.php'));
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes()
	{
		Route::prefix('api')
			->middleware('api')
			->namespace($this->namespace)
			->group(base_path('routes/api.php'));
	}

	/**
	 * Define the "dev" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapDevRoutes()
	{
		Route::middleware('web')
			->namespace($this->namespace)
			->group(base_path('routes/dev.php'));
	}
}
