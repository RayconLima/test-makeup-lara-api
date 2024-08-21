<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('products', \App\Http\Controllers\ProductController::class);
Route::get('get-products', [\App\Http\Controllers\ProductController::class, 'getProducts']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
