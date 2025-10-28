<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionDetail;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', function () {
    $items = Item::count();
    $warehouses = Warehouse::count();
    $customers = Customer::count();
    $suppliers = Supplier::count();
    $transactions = Transaction::whereMonth('transaction_date', date('m'))->whereYear('transaction_date', date('Y'))->count();
    $transaction_details = TransactionDetail::count();

    $recent_transactions = Transaction::latest()->take(5)->get()->map(function($item) {
        $item->activity_type = 'transaction';
        return $item;
    });

    $recent_items = Item::latest()->take(5)->get()->map(function($item) {
        $item->activity_type = 'item';
        return $item;
    });

    $activities = $recent_transactions->merge($recent_items)->sortByDesc('created_at')->take(5);

    return view('dashboard', compact('items', 'warehouses', 'customers', 'suppliers', 'transactions', 'transaction_details', 'activities'));
})->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('customers', CustomerController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('transaction_details', TransactionDetailController::class);
