
@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Barang: {{ $item->name }}</h1>

        {{-- Assume $item is passed from the controller --}}
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Barang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $item->category) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $item->price) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $item->stock) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Unit -->
                <div>
                    <label for="unit" class="block text-sm font-medium text-gray-700">Satuan (Contoh: Pcs, Kg, Box)</label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit', $item->unit) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <!-- Gudang -->
                <div>
                    <label for="warehouse_id" class="block text-sm font-medium text-gray-700">Gudang</label>
                    <select name="warehouse_id" id="warehouse_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        {{-- Populate with warehouses from database --}}
                        <option value="" disabled>Pilih Gudang</option>
                        @foreach ($warehouses as $warehouse )
                            <option value="{{ $warehouse->id }}" {{ $item->warehouse_id == $warehouse->id ? 'selected' : '' }}{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        {{-- Populate with suppliers from database --}}
                        <option value="" disabled selected>Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $item->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Foto Barang -->
                <div class="md:col-span-2">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Ganti Foto Barang</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @if ($item->photo)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">Foto saat ini:</p>
                            <img src="{{ asset('storage/images/' . $item->photo) }}" alt="Foto {{ $item->name }}" class="mt-2 h-24 w-24 object-cover rounded-md">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end">
                <a href="{{ route('items.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
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
