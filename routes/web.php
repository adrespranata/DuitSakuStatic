<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomesController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
});
Route::group(['middleware' => 'auth', 'log'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Incomes Category
    Route::group(['prefix' => 'IncomeCategory'], function () {
        Route::get('/', [IncomeCategoryController::class, 'index'])->name('IncomeCategory');
        Route::get('/create', [IncomeCategoryController::class, 'create'])->name('IncomeCategory.create');
        Route::post('/store', [IncomeCategoryController::class, 'store'])->name('IncomeCategory.store');
        Route::get('/edit/{incomeCategory}', [IncomeCategoryController::class, 'edit'])->name('IncomeCategory.edit');
        Route::put('/update/{incomeCategory}', [IncomeCategoryController::class, 'update'])->name('IncomeCategory.update');
        Route::delete('/destroy/{incomeCategory}', [IncomeCategoryController::class, 'destroy'])->name('IncomeCategory.destroy');
    });
    // Incomes
    Route::group(['prefix' => 'Incomes'], function () {
        Route::get('/', [IncomesController::class, 'index'])->name('Incomes');
        Route::get('/create', [IncomesController::class, 'create'])->name('Incomes.create');
        Route::post('/store', [IncomesController::class, 'store'])->name('Incomes.store');
        Route::get('/edit/{incomes}', [IncomesController::class, 'edit'])->name('Incomes.edit');
        Route::put('/update/{incomes}', [IncomesController::class, 'update'])->name('Incomes.update');
        Route::delete('/destroy/{incomes}', [IncomesController::class, 'destroy'])->name('Incomes.destroy');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
