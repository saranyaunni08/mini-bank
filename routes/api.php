<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware('auth:sanctum')->post('/transaction/credit', [TransactionController::class, 'credit']);
    Route::post('/transaction/debit', [TransactionController::class, 'debit']);
});