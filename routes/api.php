<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});


// ## Brands
Route::post('/getYearBrands', 'BrandsController@getByYear');

Route::get('/brands/{brand}', 'BrandsController@show');



// ## Categories

Route::prefix('Categories')->group(function () {
	Route::get('/{Categorie}', 'CategoriesController@show');
});

// ## Vehicles
Route::post('/getVehiclesByModel', 'VehiclesController@getVehiclesByModel');
Route::post('/getModelsByBrand', 'VehiclesController@getModelsByBrand');
Route::post('/getEnginesByVehicle', 'VehiclesController@getEnginesByVehicle');
Route::post('/getCategoriesByEngine', 'VehiclesController@getCategoriesByEngine');
Route::post('/getFuelOptionsForModel', 'VehiclesController@getFuelOptionsForModel');

// ## Type
Route::post('/getCategoryTypes', 'TypesController@getTypesByCategory');


// ## Cart

Route::get('/cart', 'CartController@index');
Route::post('/cart/add/{part}', 'CartController@add')->name('cart.add');
Route::post('/cart/remove/{part}', 'CartController@remove')->name('cart.remove');
Route::post('/cart/update/{part}', 'CartController@update')->name('cart.update');
Route::get('/cart/{id}/quantity', 'CartController@getQuantity')->name('cart.quantity');


// ## Contact

Route::get('/contact', 'ContactController@show')
	->template(\App\Nova\Templates\Contact::class)
	->name('contact');
Route::post('/contact', 'ContactController@send');

// ## Articles

Route::get('/articles/count', 'CatalogCountController@articles');

// Langues
Route::get('/lang/{locale}', 'LocalizationController@switch')
	->name('locale')
	->where('locale', '(en|fr|ar)');
Route::get('/', 'PagesController@index');

Route::get('/part/{part}', '\API\PartsController@show');
Route::view('/track-order', 'track-order');


Route::get('/categories/{category}', 'CategoriesController@show')->name('category');
Route::get('/types/{type}', 'TypesController@show')->name('type');

// ## ath
Route::middleware('auth', 'verified')->group(function () {
	Route::prefix('account')->group(function () {
		Route::view('password', 'auth.passwords.change')->middleware('password.confirm');
		Route::post('change-password', 'AccountController@changePassword')->name('password.change');
		Route::get('profile', 'ProfileController@edit')->name('profile.edit');
		Route::post('profile', 'ProfileController@update')->name('profile.update');
		Route::get('shop', 'PartsController@index')->name('shop');
		Route::get('orders', 'OrdersController@index')->name('orders');
	});
	Route::post('/parts/add', 'PartsController@store')->name('part.add');
});




// ## Catalog routes

Route::prefix('brands/{brand}')->group(function () {
	Route::get('{slug?}', 'BrandsController@show');
	Route::prefix('{brand_slug?}/models/{model}/{model_slug?}/vehicles/{vehicle}')->group(function () {
		Route::get('{slug?}', 'VehiclesController@show')->name('vehicle');
		Route::get('{vehicle_slug?}/cars/{car}/{car_slug?}/engines/{engine}/{slug?}', 'EnginesController@show')->name('engine');
		Route::get('{vehicle_slug?}/cars/{car}/{slug?}', 'CarsController@show')->name('car');
	});
});


// ## Garage

Route::get('garage', 'GarageController@show');


// ## Receipt
Route::get('print/receipt/{receipt}', 'ReceiptsController@print');
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');
Route::post('/review/{part}', 'ReviewsController@store');

// ## Store
Route::get('/store/{store}', 'StoresController@show');
Route::get('/store/{store}/contact', 'StoreContactController@show');
Route::get('/store/{store}/about', 'StoreAboutController@show');

Route::view('/pricing', 'pricing');

// ## Wishlist
Route::prefix('wishlist')->group(function () {
	Route::get('/', 'WishlistController@index');
	Route::post('add/{part}', 'WishlistController@add');
	Route::post('remove/{part}', 'WishlistController@remove');
});
