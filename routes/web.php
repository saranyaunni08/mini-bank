<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer and transaction routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('index');  // Matches `index.blade.php`
    })->name('dashboard');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/add-customer', [CustomerController::class, 'create'])->name('add-customer');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer-details');

    Route::get('/transactions/{id}', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions/credit', [TransactionController::class, 'credit'])->name('transactions.credit');
    Route::post('/transactions/debit', [TransactionController::class, 'debit'])->name('transactions.debit');
    
});
