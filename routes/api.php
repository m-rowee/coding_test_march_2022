<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::put('/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
});
