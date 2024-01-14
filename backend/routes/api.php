<?php

use App\Http\Controllers\AuthController;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'create']);

Route::apiResource('auth', AuthController::class);

// Route::middleware(['auth:sanctum'])->group(function () {
//     //
// });


Route::namespace('App\Http\Controllers')->group(function () {
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

Route::get('auth/logout', [AuthController::class, 'logout']);
