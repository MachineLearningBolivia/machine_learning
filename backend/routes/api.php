<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\OperationTypeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\CategoriaController;
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

Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/verify', [AuthController::class, 'verify']);
    Route::apiResource('boxes', BoxController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/import', [ExcelController::class, 'importCategories']);
    Route::apiResource('categorias', CategoriaController::class);
    Route::post('categorias/import', [ExcelController::class, 'importCategorias']);
    Route::apiResource('products', ProductController::class);
    Route::post('products/import', [ExcelController::class, 'importProducts']);
    Route::apiResource('maquinaria', MaquinariaController::class);
    Route::post('maquinaria/import', [ExcelController::class, 'importMaquinaria']);
    Route::apiResource('configurations', ConfigurationController::class);
    Route::apiResource('operations', OperationController::class);
    Route::apiResource('operationTypes', OperationTypeController::class);
    Route::apiResource('people', PersonController::class);
    Route::apiResource('sales', SaleController::class);
    Route::apiResource('users', UserController::class);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::apiResource('categories', CategoryController::class)->only('index', 'show');
Route::apiResource('categorias', CategoriaController::class)->only('index', 'show');
Route::apiResource('products', ProductController::class)->only('index', 'show');
Route::apiResource('maquinaria', MaquinariaController::class)->only('index', 'show');