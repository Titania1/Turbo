<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * Register observers.
	 */
	public function boot(): void
	{
		\App\User::observe(\App\Observers\UserObserver::class);
		\App\Profile::observe(\App\Observers\ProfileObserver::class);
		\App\Review::observe(\App\Observers\ReviewObserver::class);

		$this->observeCatalog();

		\App\Part::observe(\App\Observers\PartObserver::class);
		\App\Type::observe(\App\Observers\TypeObserver::class);

		$this->observeStock();
	}

	private function observeCatalog(): void
	{
		\App\Brand::observe(\App\Observers\BrandObserver::class);
		\App\Model::observe(\App\Observers\ModelObserver::class);
		\App\Engine::observe(\App\Observers\EngineObserver::class);
		\App\Vehicle::observe(\App\Observers\VehicleObserver::class);
		\App\Car::observe(\App\Observers\CarObserver::class);
		\App\Category::observe(\App\Observers\CategoryObserver::class);
	}

	private function observeStock(): void
	{
		\App\Invoice::observe(\App\Observers\InvoiceObserver::class);
		\App\Receipt::observe(\App\Observers\ReceiptObserver::class);
		\App\Order::observe(\App\Observers\OrderObserver::class);
		\App\Store::observe(\App\Observers\StoreObserver::class);
		\App\StoreContact::observe(\App\Observers\StoreContactObserver::class);
		\App\StoreAbout::observe(\App\Observers\StoreAboutObserver::class);
		\App\Supplier::observe(\App\Observers\SupplierObserver::class);
		\App\Garage::observe(\App\Observers\GarageObserver::class);
		\App\Client::observe(\App\Observers\ClientObserver::class);
	}
}
