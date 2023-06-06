<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AlbumController;

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

Route::prefix('auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/user', [UserController::class, 'getUser'])->middleware('jwt.auth');
    Route::post('/refresh-token', [UserController::class, 'refreshToken'])->middleware('jwt.refresh');
});

Route::prefix('album')->group(function () {
    Route::post('/all', [AlbumController::class, 'albums']);
});
