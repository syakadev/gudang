
@extends('layouts.app')

@section('title', 'Tambah Barang Baru')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Barang Baru</h1>

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- user id --}}
                <input type="hidden" name="user_id"
                value="
                {{-- {{ auth()->user->id }} --}}


                {{-- for testing --}}
                2
                ">


                <!-- Nama Barang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" name="category" id="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Unit -->
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700">Satuan (Contoh: Pcs, Kg, Box)</label>
                    <input type="text" name="unit" id="unit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Gudang -->
                <div>
                    <label for="warehouse_id" class="block text-sm font-medium text-gray-700">Gudang</label>
                    <select name="warehouse_id" id="warehouse_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        {{-- Populate with warehouses from database --}}
                        <option value="" disabled>Pilih Gudang</option>
                        @foreach ($werehouses as $werehouse )
                            <option value="{{ $werehouse->id }}">{{ $werehouse->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        {{-- Populate with suppliers from database --}}
                        <option value="" disabled>Pilih Supplier</option>
                        @foreach ($supliers as $supplier )
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Foto Barang -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-medium text-gray-700" >
                    <input type="file" name="photo" id="photo" accept="image/*" capture="environment" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end">
                <a href="{{ route('items.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Simpan Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
