<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MockApiController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/mock', [MockApiController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/guru', [UserController::class, 'store']);

});
