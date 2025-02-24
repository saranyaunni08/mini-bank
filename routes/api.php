<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\CustomerController;

Route::post('/login', [AuthController::class, 'login']); // API login route

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/transactions/credit', [TransactionController::class, 'credit']);
    Route::post('/transactions/debit', [TransactionController::class, 'debit']);
});
