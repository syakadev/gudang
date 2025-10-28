@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, Admin!</h1>
        <p class="text-gray-500">Berikut adalah ringkasan aktivitas gudang Anda.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Barang Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Barang</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $items }}</p>
                </div>
            </div>
        </div>

        <!-- Total Supplier Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Supplier</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $suppliers}}</p>
                </div>
            </div>
        </div>

        <!-- Total Pelanggan Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $customers }}</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Bulan Ini Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Transaksi Bulan Ini</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $transactions }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>
        <div class="bg-white shadow-md rounded-lg p-6">
            <ul class="divide-y divide-gray-200">
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Barang baru ditambahkan: <span class="font-bold">Laptop Pro 15"</span></p>
                        <p class="text-sm text-gray-500">Oleh: Admin User - 2 jam yang lalu</p>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Detail</a>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Transaksi baru: <span class="font-bold">INV/20251028/001</span></p>
                        <p class="text-sm text-gray-500">Oleh: Admin User - 3 jam yang lalu</p>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Detail</a>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Stok barang diperbarui: <span class="font-bold">Keyboard Mekanikal</span></p>
                        <p class="text-sm text-gray-500">Oleh: Admin User - 5 jam yang lalu</p>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Detail</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
