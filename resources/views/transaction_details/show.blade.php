@extends('layouts.app')

@section('title', 'Detail Detail Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Detail Transaksi</h1>
            <a href="{{ route('transaction_details.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500">ID Detail Transaksi</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transactionDetail->id }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">ID Transaksi</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transactionDetail->transaction_id }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Barang</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transactionDetail->item->name }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Jumlah</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transactionDetail->quantity }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Harga</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($transactionDetail->total_price, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
