<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('users', \App\Http\Controllers\UserController::class);
Route::apiResource('clients', \App\Http\Controllers\ClientController::class);
Route::apiResource('brands', \App\Http\Controllers\BrandController::class);
Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
Route::apiResource('types', \App\Http\Controllers\TypeController::class);
Route::apiResource('products', \App\Http\Controllers\ProductController::class);
Route::get('get-products', [\App\Http\Controllers\ProductController::class, 'getProductsByMakeupApi']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
