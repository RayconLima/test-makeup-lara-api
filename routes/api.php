<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);
Route::apiResource('item-sales', \App\Http\Controllers\ItemSaleController::class);
Route::get('get-products', [\App\Http\Controllers\ProductController::class, 'getProductsByMakeupApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
    Route::apiResource('clients', \App\Http\Controllers\ClientController::class);
    Route::apiResource('brands', \App\Http\Controllers\BrandController::class);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('types', \App\Http\Controllers\TypeController::class);
    Route::apiResource('products', \App\Http\Controllers\ProductController::class);
    Route::apiResource('sales', \App\Http\Controllers\SaleController::class);
});

