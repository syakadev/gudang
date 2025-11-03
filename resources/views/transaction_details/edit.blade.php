@extends('layouts.app')

@section('title', 'Edit Detail Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Detail Transaksi</h1>

        <form action="{{ route('transaction_details.update', $transactionDetail->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="transaction_id" class="block text-sm font-medium text-gray-700">ID Transaksi</label>
                    <input type="text" name="transaction_id" id="transaction_id" value="{{ $transactionDetail->transaction_id }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="item_id" class="block text-sm font-medium text-gray-700">Barang</label>
                    <select name="item_id" id="item_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        {{-- Populate with items --}}
                    </select>
                </div>
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $transactionDetail->quantity }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="total_price" class="block text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="number" name="total_price" id="total_price" value="{{ $transactionDetail->total_price }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('transaction_details.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
