<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('verify', [AuthController::class, 'verify']);

    Route::
            namespace('App\Http\Controllers')->group(function () {
                Route::apiResource('boxes', BoxesController::class);
                Route::apiResource('categories', CategoriesController::class);
                Route::apiResource('products', ProductsController::class);
                Route::apiResource('configurations', ConfigurationsController::class);
                Route::apiResource('operations', OperationsController::class);
                Route::apiResource('operationTypes', OperationTypesController::class);
                Route::apiResource('people', PeopleController::class);
                Route::apiResource('sales', SalesController::class);
                Route::apiResource('users', UserController::class);
            });

    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('client/products', [ProductsController::class, 'index']);
