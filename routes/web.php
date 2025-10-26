<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::apiResource('barang', BarangController::class);
    Route::apiResource('gudang', GudangController::class);
    Route::apiResource('pelanggan', PelangganController::class);
    Route::apiResource('supplier', SupplierController::class);
    Route::apiResource('transaksi', TransaksiController::class);
    Route::apiResource('detail-transaksi', DetailTransaksiController::class);
});
