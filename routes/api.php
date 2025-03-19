<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarReturnController;
use App\Http\Controllers\PenaltiesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::apiResource('register', RegisterController::class);
    Route::apiResource('car', CarController::class);
    Route::apiResource('rent', RentController::class);
    Route::apiResource('penalties', PenaltiesController::class);
    Route::apiResource('return', CarReturnController::class);
});
