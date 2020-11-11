<?php

declare(strict_types=1);

namespace App\Providers;

use App\Nova\Dashboards\Statistics;
use Illuminate\Support\Facades\Gate;
use Jubeki\Nova\Cards\Linkable\Linkable;
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Vyuldashev\NovaPermission\NovaPermissionTool;
use Whitecube\NovaPage\NovaPageTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Nova::style('admin', public_path('css/admin.css'));
		if (app()->isLocale('fr')) {
			Nova::translations([
				'Load per file'  => 'Importer par excel',
				'Manual loading' => 'Chargement Manuel',
			]);
		}
		parent::boot();
	}

	/**
	 * Register the Nova routes.
	 *
	 * @return void
	 */
	protected function routes()
	{
		Nova::routes()
			->withAuthenticationRoutes()
			->withPasswordResetRoutes()
			->register();
	}

	/**
	 * Register the Nova gate.
	 *
	 * This gate determines who can access Nova in non-local environments.
	 *
	 * @return void
	 */
	protected function gate()
	{
		Gate::define('viewNova', function ($user) {
			return $user->hasPermissionTo('Access Stock');
		});
	}

	/**
	 * Get the cards that should be displayed on the default Nova dashboard.
	 *
	 * @return array
	 */
	protected function cards()
	{
		return [
			(new Linkable())
				->title(__('Stock'))
				->url('/resources/parts')
				->subtitle(__('List of parts')),

			(new Linkable())
				->title(__('Clients'))
				->url('/resources/clients')
				->subtitle(__('List of clients')),

			(new Linkable())
				->title(__('Suppliers'))
				->url('/resources/suppliers')
				->subtitle(__('List of suppliers')),

			(new Linkable())
				->title(__('Receipts'))
				->url('/resources/receipts')
				->subtitle(__('List of receipts')),

			(new Linkable())
				->title(__('Invoices'))
				->url('/resources/invoices')
				->subtitle(__('List of invoices')),

			(new Linkable())
				->title(__('Orders'))
				->url('/resources/orders')
				->subtitle(__('List of orders')),

			(new Linkable())
				->title(__('Store'))
				->url('/resources/stores')
				->subtitle(__('My Public Store')),

			(new Linkable())
				->title(__('Wishlists'))
				->url('/resources/wishlists')
				->subtitle(__('My Wishlists')),

			(new Linkable())
				->title(__('Statistics'))
				->url('/dashboards/statistics')
				->subtitle(__('Statistics')),

			(new Linkable())
				->title(__('Categories'))
				->url('/resources/categories')
				->subtitle(__('Categories')),
		];
	}

	/**
	 * Get the extra dashboards that should be displayed on the Nova dashboard.
	 *
	 * @return array
	 */
	protected function dashboards()
	{
		return [
			new Statistics(),
		];
	}

	/**
	 * Get the tools that should be listed in the Nova sidebar.
	 *
	 * @return array
	 */
	public function tools()
	{
		return [
			NovaPageTool::make()->canSee(fn ($request) => $request->user()->hasRole('Super Admin')),
			NovaPermissionTool::make()
				->canSee(fn ($request)             => $request->user()->hasRole('Super Admin')),
			LogsTool::make()->canSee(fn ($request) => $request->user()->hasRole('Super Admin')),
		];
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
