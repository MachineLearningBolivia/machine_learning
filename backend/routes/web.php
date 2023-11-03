<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ConfigurationsController;
use App\Http\Controllers\OperationTypesController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SalesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('boxes', BoxesController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('products', ProductsController::class);
Route::resource('configurations', ConfigurationsController::class);
Route::resource('operations', OperationsController::class);
Route::resource('operationTypes', OperationTypesController::class);
Route::resource('people', PeopleController::class);
Route::resource('sales', SalesController::class);