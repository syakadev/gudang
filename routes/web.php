<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::apiResource('items', ItemController::class);
    Route::apiResource('warehouses', WarehouseController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('transaction-details', TransactionDetailController::class);
});
