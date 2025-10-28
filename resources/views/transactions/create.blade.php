@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Transaksi</h1>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="transaction_type" class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                    <select id="transaction_type" name="transaction_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="in">Barang Masuk</option>
                        <option value="out">Barang Keluar</option>
                    </select>
                </div>
                <div>
                    <label for="supplier_customer" class="block text-sm font-medium text-gray-700">Supplier / Pelanggan</label>
                    <select id="supplier_customer" name="supplier_customer" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        {{-- Options will be populated dynamically --}}
                        <option>Pilih Supplier/Pelanggan</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900">Detail Barang</h2>
                <div class="mt-4 space-y-4" id="transaction-items">
                    <div class="flex items-center space-x-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="items[0][item_id]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                {{-- Options will be populated dynamically --}}
                                <option>Pilih Barang</option>
                            </select>
                        </div>
                        <div class="w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="items[0][quantity]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah">
                        </div>
                        <div class="w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="items[0][price]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga">
                        </div>
                        <button type="button" class="text-red-600 hover:text-red-900 mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                <button type="button" id="add-item" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Tambah Barang
                </button>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addItemButton = document.getElementById('add-item');
        const transactionItems = document.getElementById('transaction-items');
        let itemIndex = 1;

        addItemButton.addEventListener('click', function () {
            const newItemRow = document.createElement('div');
            newItemRow.classList.add('flex', 'items-center', 'space-x-4');
            newItemRow.innerHTML = `
                <div class="w-1/2">
                    <select name="items[${itemIndex}][item_id]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option>Pilih Barang</option>
                    </select>
                </div>
                <div class="w-1/4">
                    <input type="number" name="items[${itemIndex}][quantity]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah">
                </div>
                <div class="w-1/4">
                    <input type="number" name="items[${itemIndex}][price]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga">
                </div>
                <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            transactionItems.appendChild(newItemRow);
            itemIndex++;
        });

        transactionItems.addEventListener('click', function (e) {
            if (e.target.closest('.remove-item')) {
                e.target.closest('.flex').remove();
            }
        });
    });
</script>
@endpush
