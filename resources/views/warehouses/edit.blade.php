
@extends('layouts.app')

@section('title', 'Edit Gudang')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Gudang: {{ $warehouse->name }}</h1>

        {{-- Assume $warehouse is passed from the controller --}}
        <form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6">
                <!-- Nama Gudang -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Gudang</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $warehouse->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="address" id="address" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>{{ old('address', $warehouse->address) }}</textarea>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex justify-end">
                <a href="{{ route('warehouses.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
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
