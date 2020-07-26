<?php

declare(strict_types=1);

namespace App\Providers;

use App\Part;
use App\Type;
use App\User;
use App\Brand;
use App\Order;
use App\Store;
use App\Review;
use App\Invoice;
use App\Profile;
use App\Receipt;
use App\Category;
use App\Garage;
use App\Supplier;
use App\StoreContact;
use App\Observers\PartObserver;
use App\Observers\TypeObserver;
use App\Observers\UserObserver;
use App\Observers\BrandObserver;
use App\Observers\OrderObserver;
use App\Observers\StoreObserver;
use App\Observers\ReviewObserver;
use App\Observers\InvoiceObserver;
use App\Observers\ProfileObserver;
use App\Observers\ReceiptObserver;
use App\Observers\CategoryObserver;
use App\Observers\GarageObserver;
use App\Observers\SupplierObserver;
use App\Observers\StoreContactObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Part::observe(PartObserver::class);
		Profile::observe(ProfileObserver::class);
		Type::observe(TypeObserver::class);
		Category::observe(CategoryObserver::class);
		Invoice::observe(InvoiceObserver::class);
		Receipt::observe(ReceiptObserver::class);
		Brand::observe(BrandObserver::class);
		Review::observe(ReviewObserver::class);
		Order::observe(OrderObserver::class);
		User::observe(UserObserver::class);
		Store::observe(StoreObserver::class);
		StoreContact::observe(StoreContactObserver::class);
		Supplier::observe(SupplierObserver::class);
		Garage::observe(GarageObserver::class);
	}
}
