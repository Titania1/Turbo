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
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'LocalizationController@switch')
    ->name('locale')
    ->where('locale', '(en|fr|ar)');
Route::get('/', 'PagesController@index');
Route::post('/search', 'SearchController@search')->name('search');
Route::view('/about', 'about')->name('about');
Route::get('/contact', 'ContactController@show')
    ->template(\App\Nova\Templates\Contact::class)
    ->name('contact');
Route::post('/contact', 'ContactController@send');
Route::get('/part/{part}', 'PartsController@show')->name('part');
Route::view('/track-order', 'track-order')->name('track');

Route::get('/cart', 'CartController@index');
Route::post('/cart/add/{part}', 'CartController@add')->name('cart.add');
Route::post('/cart/remove/{part}', 'CartController@remove')->name('cart.remove');
Route::post('/cart/update/{part}', 'CartController@update')->name('cart.update');
Route::get('/cart/{id}/quantity', 'CartController@getQuantity')->name('cart.quantity');
Route::get('/categories/{category}', 'CategoriesController@show')->name('category');
Route::get('/types/{type}', 'TypesController@show')->name('type');
Route::view('/terms', 'terms');
Route::view('/faq', 'faq');
Route::view('/components', 'components');
Route::view('/typography', 'typography');
Route::view('/checkout', 'checkout');
Route::view('/compare', 'compare');
Route::view('/product', 'product');
Route::middleware('auth', 'verified')->group(function () {
    Route::prefix('account')->group(function () {
        Route::view('password', 'auth.passwords.change')->middleware('password.confirm');
        Route::post('change-password', 'AccountController@changePassword')->name('password.change');
        Route::get('profile', 'ProfileController@edit')->name('profile.edit');
        Route::post('profile', 'ProfileController@update')->name('profile.update');
        Route::get('shop', 'PartsController@index')->name('shop');
        Route::get('orders', 'OrdersController@index')->name('orders');
        // Route::get('garage', 'GarageController@show')->name('garage');
    });
    Route::post('/parts/add', 'PartsController@store')->name('part.add');
});

// Catalog routes

Route::prefix('brands/{brand}')->group(function () {
    Route::get('{slug?}', 'BrandsController@show')->name('brand');
    Route::prefix('{brand_slug?}/models/{model}/{model_slug?}/vehicles/{vehicle}')->group(function () {
        Route::get('{slug?}', 'VehiclesController@show')->name('vehicle');
        Route::get('{vehicle_slug?}/cars/{car}/{car_slug?}/engines/{engine}/{slug?}', 'EnginesController@show')->name('engine');
        Route::get('{vehicle_slug?}/cars/{car}/{slug?}', 'CarsController@show')->name('car');
    });
});

Route::get('print/receipt/{receipt}', 'ReceiptsController@print');
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->where('provider', '(google|facebook)');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::post('/review/{part}', 'ReviewsController@store')->name('review.store');
Route::get('/store/{store}', 'StoresController@show')->name('store');
Route::get('/store/{store}/contact', 'StoreContactController@show')->name('store.contact');
Route::get('/store/{store}/about', 'StoreAboutController@show')->name('store.about');
Route::view('/pricing', 'pricing');
Route::post('/newsletter', 'NewsletterController@store')->name('newsletter');
// Wishlist routes
Route::prefix('wishlist')->group(function () {
    Route::get('/', 'WishlistController@index')->name('wishlist');
    Route::post('add/{part}', 'WishlistController@add')->name('wishlist.add');
    Route::post('remove/{part}', 'WishlistController@remove')->name('wishlist.remove');
});
Route::fallback('FallBackController');
