
@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Barang</h1>
            <a href="{{ route('items.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Tambah Barang
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="mb-4">
            <input type="text" placeholder="Cari barang..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Items Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- Example Item 1 --}}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Laptop Pro 15"</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Elektronik</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                50
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 25.000.000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            <a href="#" class="ml-4 text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="ml-4 text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                    {{-- Example Item 2 --}}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Keyboard Mekanikal</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aksesoris</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                15
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp 1.200.000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            <a href="#" class="ml-4 text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="ml-4 text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                    {{-- Add more items here later with @foreach --}}
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{-- Pagination links will go here --}}
        </div>
    </div>
</div>
@endsection
