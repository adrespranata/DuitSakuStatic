<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\IncomesController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth');
});
Route::group(['middleware' => 'auth', 'log'], function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/getIncomesPerMonth', [DashboardController::class, 'getIncomesPerMonth']);
    Route::get('/getIncomeByCategory', [DashboardController::class, 'getIncomeByCategory']);
    Route::get('/getCategoryName/{categoryId}', [DashboardController::class, 'getCategoryName']);
    Route::get('/getExpensesPerMonth', [DashboardController::class, 'getExpensesPerMonth']);
    Route::get('/getExpenseByCategory', [DashboardController::class, 'getExpenseByCategory']);
    Route::get('/getCategoryNameExpenses/{categoryId}', [DashboardController::class, 'getCategoryNameExpenses']);


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

    // Expense Category
    Route::group(['prefix' => 'ExpenseCategory'], function () {
        Route::get('/', [ExpenseCategoryController::class, 'index'])->name('ExpenseCategory');
        Route::get('/create', [ExpenseCategoryController::class, 'create'])->name('ExpenseCategory.create');
        Route::post('/store', [ExpenseCategoryController::class, 'store'])->name('ExpenseCategory.store');
        Route::get('/edit/{expenseCategory}', [ExpenseCategoryController::class, 'edit'])->name('ExpenseCategory.edit');
        Route::put('/update/{expenseCategory}', [ExpenseCategoryController::class, 'update'])->name('ExpenseCategory.update');
        Route::delete('/destroy/{expenseCategory}', [ExpenseCategoryController::class, 'destroy'])->name('ExpenseCategory.destroy');
    });
    // Expenses
    Route::group(['prefix' => 'Expenses'], function () {
        Route::get('/', [ExpensesController::class, 'index'])->name('Expenses');
        Route::get('/create', [ExpensesController::class, 'create'])->name('Expenses.create');
        Route::post('/store', [ExpensesController::class, 'store'])->name('Expenses.store');
        Route::get('/edit/{expenses}', [ExpensesController::class, 'edit'])->name('Expenses.edit');
        Route::put('/update/{expenses}', [ExpensesController::class, 'update'])->name('Expenses.update');
        Route::delete('/destroy/{expenses}', [ExpensesController::class, 'destroy'])->name('Expenses.destroy');
    });

    // Payment Types
    Route::group(['prefix' => 'PaymentType'], function () {
        Route::get('/', [PaymentTypeController::class, 'index'])->name('PaymentType');
        Route::get('/create', [PaymentTypeController::class, 'create'])->name('PaymentType.create');
        Route::post('/store', [PaymentTypeController::class, 'store'])->name('PaymentType.store');
        Route::get('/edit/{paymentType}', [PaymentTypeController::class, 'edit'])->name('PaymentType.edit');
        Route::put('/update/{paymentType}', [PaymentTypeController::class, 'update'])->name('PaymentType.update');
        Route::delete('/destroy/{paymentType}', [PaymentTypeController::class, 'destroy'])->name('PaymentType.destroy');
        Route::get('/getPaymentTypes', [PaymentTypeController::class, 'getPaymentTypes'])->name('getPaymentTypes');
    });
    // Reports
    Route::get('/Reports', [ReportController::class, 'index'])->name('Reports');
    Route::post('/Reports/store', [ReportController::class, 'store'])->name('Reports.store');

    Route::group(['prefix' => 'Profiles'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('Profiles');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');
        Route::post('/updateDetails', [ProfileController::class, 'updateDetails'])->name('updateDetails');
        Route::post('/updatePicture', [ProfileController::class, 'updatePicture'])->name('updatePicture');
    });
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
