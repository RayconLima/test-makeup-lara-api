<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', \App\Http\Controllers\ProductController::class);
Route::apiResource('brands', \App\Http\Controllers\BrandController::class);
Route::get('get-products', [\App\Http\Controllers\ProductController::class, 'getProductsByMakeupApi']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
