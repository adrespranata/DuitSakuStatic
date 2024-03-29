<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
});
Route::group(['middleware' => 'auth', 'log'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
