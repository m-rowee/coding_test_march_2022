<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['web'])->group(function () {
    Route::middleware('auth')->group(function () {

        Route::get('/', function () {
            return view('home');
        });
        Route::get('/info', [UserController::class, 'info'])->name('user.info');
    });


    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::get('/registration', [AuthController::class, 'registration'])->name('auth.registration');
    });
});
