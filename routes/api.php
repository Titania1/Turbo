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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/getYearBrands', 'BrandsController@getByYear');
Route::post('/getVehiclesByModel', 'VehiclesController@getVehiclesByModel');
Route::post('/getModelsByBrand', 'VehiclesController@getModelsByBrand');
Route::post('/getEnginesByCar', 'VehiclesController@getEnginesByCar');
Route::post('/getCategoriesByEngine', 'VehiclesController@getCategoriesByEngine');
Route::post('/getFuelOptionsForModel', 'VehiclesController@getFuelOptionsForModel');
Route::post('/getCategoryTypes', 'TypesController@getTypesByCategory');
Route::post('/getPartsByCategory', 'ProductsController@getPartsByCategory');
