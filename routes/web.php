<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', function() {
        return view('welcome');
    })->name('home');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function() {
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('auth', [UserController::class, 'auth'])->name('user.auth');
    Route::middleware('signed')->get('session/{email}', [UserController::class, 'session'])->name('user.session');
    Route::get('register', [UserController::class, 'register'])->name('register');
    Route::post('store', [UserController::class, 'store'])->name('user.store');
});
