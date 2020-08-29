<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WishlistServiceProvider extends ServiceProvider
{

	public function register()
	{

		$this->app->bind('wishlist', 'App\wishlist');

		$config = __DIR__ . '/Config/wishlist.php';
		$this->mergeConfigFrom($config, 'wishlist');

		$this->publishes([__DIR__ . '/Config/wishlist.php' => config_path('wishlist.php')], 'config');

		$this->app['events']->listen(Logout::class, function () {
			if ($this->app['config']->get('wishlist.destroy_on_logout')) {
				$this->app->make(SessionManager::class)->forget('wishlist');
			}
		});

		$this->publishes([
			realpath(__DIR__ . '/Database/migrations') => $this->app->databasePath() . '/migrations',
		], 'migrations');
	}
}
