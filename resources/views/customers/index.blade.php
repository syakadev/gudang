
@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pelanggan</h1>
            <a href="{{ route('customers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                Tambah Pelanggan
            </a>
        </div>

        <!-- Customers Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- Example Customer --}}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Andi Setiawan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jl. Merdeka No. 45, Bandung</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">089876543210</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                            <a href="#" class="ml-4 text-blue-600 hover:text-blue-900">Edit</a>
                            <a href="#" class="ml-4 text-red-600 hover:text-red-900">Hapus</a>
                        </td>
                    </tr>
                    {{-- Add more customers here later with @foreach --}}
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
