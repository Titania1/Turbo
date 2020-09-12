<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('nova-api/articles/count', 'CatalogCountController@articles');
Auth::routes(['verify' => true]);
Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('lang/{locale}', 'LocalizationController@switch')
	->name('locale')
	->where('locale', '(en|fr|ar)');
Route::get('', 'PagesController@index');
Route::post('search', 'SearchController@search')->name('search');
Route::view('about', 'about')->name('about');
Route::get('contact', 'ContactController@show')
	->template(\App\Nova\Templates\Contact::class)
	->name('contact');
Route::post('contact', 'ContactController@send');
Route::get('part/{part}', 'PartsController@show')->name('part');
Route::view('track-order', 'track-order')->name('track');
Route::view('wishlist', 'wishlist')->name('wishlist');
Route::get('cart', 'CartController@index');
Route::post('cart/add/{part}', 'CartController@add')->name('cart.add');
Route::post('cart/remove/{part}', 'CartController@remove')->name('cart.remove');
Route::get('categories/{category}', 'CategoriesController@show')->name('category');
Route::get('types/{type}', 'TypesController@show')->name('type');
Route::view('terms', 'terms');
Route::view('faq', 'faq');
Route::view('components', 'components');
Route::view('typography', 'typography');
Route::view('checkout', 'checkout');
Route::view('compare', 'compare');
Route::view('product', 'product');
Route::middleware('auth', 'verified')->group(function () {
	Route::view('account/addresses', 'account-addresses');
	Route::view('account/password', 'auth.passwords.change')->middleware('password.confirm');
	Route::post('account/change-password', 'AccountController@changePassword')->name('password.change');
	Route::view('account/orders', 'account-orders');
	Route::get('account/profile', 'ProfileController@edit')->name('profile.edit');
	Route::post('account/profile', 'ProfileController@update')->name('profile.update');
	Route::get('account/shop', 'PartsController@index')->name('shop');
	Route::get('account/garage', 'GarageController@show')->name('garage');
	Route::post('parts/add', 'PartsController@store')->name('part.add');
});
Route::view('shop-list', 'shop-list');
Route::view('shop-table', 'shop-table');
Route::view('shop-right-sidebar', 'shop-right-sidebar');
Route::view('shop-right-sidebar', 'shop-right-sidebar');
Route::view('post-right', 'post-right');
Route::view('post-left', 'post-left');
Route::view('post-width', 'post-width');
Route::view('blog-classic-left', 'blog-classic-left');
Route::view('blog-classic-right', 'blog-classic-right');
Route::view('category-3-sidebar', 'category-3-sidebar');
Route::view('category-4-sidebar', 'category-4-sidebar');
Route::view('category-5-sidebar', 'category-5-sidebar');
Route::view('category-4-full', 'category-4-full');
Route::view('category-5-full', 'category-5-full');
Route::view('category-6-full', 'category-6-full');
Route::view('category-7-full', 'category-7-full');
Route::view('category-right-sidebar', 'category-right-sidebar');
// Catalog routes
Route::get('brands/{brand}', 'BrandsController@show')->name('brand');
Route::get('models/{model}', 'EnginesController@index')->name('model');
Route::get('engines/{engine}', 'EnginesController@show')->name('engine');
Route::get('print/receipt/{receipt}', 'ReceiptsController@print');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider', '(google|facebook)');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::post('review/{part}', 'ReviewsController@store')->name('review.store');
Route::get('store/{store}', 'StoresController@show')->name('store');
Route::get('store/{store}/contact', 'StoreContactController@show')->name('store.contact');
Route::get('store/{store}/about', 'StoreAboutController@show')->name('store.about');
Route::view('pricing', 'pricing');
Route::get('wishlist', 'WishlistController@index')->name('wishlist');
Route::post('wishlist/add/{part}', 'WishlistController@add')->name('wishlist.add');
Route::post('wishlist/remove/{part}', 'WishlistController@remove')->name('wishlist.remove');
Route::get('/newsletter', 'NewsletterController@create')->name('create');
Route::post('/newsletter', 'NewsletterController@store')->name('newsletter.store');

// Keep this as the last route, catches everything else
Route::fallback('FallBackController');
