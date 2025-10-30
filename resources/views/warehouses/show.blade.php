
@extends('layouts.app')

@section('title', 'Detail Gudang: ' . $warehouse->name)

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Gudang</h1>
            <div>
                <a href="{{ route('warehouses.edit', $warehouse->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Edit
                </a>
                <a href="{{ route('warehouses.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 ml-2">
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        {{-- Assume $warehouse is passed from the controller --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500">Nama Gudang</p>
                <p class="text-lg text-gray-900">{{ $warehouse->name }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm font-medium text-gray-500">Alamat</p>
                <p class="text-lg text-gray-900">{{ $warehouse->address }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tanggal Dibuat</p>
                <p class="text-lg text-gray-900">{{ $warehouse->created_at->format('d F Y H:i') }}</p>
            </div>
        </div>

    </div>
</div>
@endsection
