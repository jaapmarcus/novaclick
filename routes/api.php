<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordpressController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/wizard', [\App\Http\Controllers\WordpressController::class, 'wizardInfo'])->middleware('auth:sanctum');
Route::get('/places', [\App\Http\Controllers\WordpressController::class, 'placesInfo'])->middleware('auth:sanctum');
