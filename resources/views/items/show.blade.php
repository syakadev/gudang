
@extends('layouts.app')

@section('title', 'Detail Barang: ' . $item->name)

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Barang</h1>
            <div>
                <a href="{{ route('items.edit', $item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Edit
                </a>
                <a href="{{ route('items.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 ml-2">
                    Kembali ke Daftar
                </a>
            </div>
        </div>

        {{-- Assume $item is passed from the controller --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama Barang</p>
                        <p class="text-lg text-gray-900">{{ $item->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kategori</p>
                        <p class="text-lg text-gray-900">{{ $item->category ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Harga</p>
                        <p class="text-lg text-gray-900">Rp {{ number_format($item->price, 2, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Stok</p>
                        <p class="text-lg text-gray-900">{{ $item->stock }} {{ $item->unit }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Gudang</p>
                        <p class="text-lg text-gray-900">{{ $item->warehouse->name ?? '-' }}</p> {{-- Assuming Warehouse relationship --}}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Supplier</p>
                        <p class="text-lg text-gray-900">{{ $item->supplier->name ?? '-' }}</p> {{-- Assuming Supplier relationship --}}
                    </div>
                     <div>
                        <p class="text-sm font-medium text-gray-500">Ditambahkan Oleh</p>
                        <p class="text-lg text-gray-900">{{ $item->user->name ?? '-' }}</p> {{-- Assuming User relationship --}}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tanggal Ditambahkan</p>
                        <p class="text-lg text-gray-900">{{ $item->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="md:col-span-1">
                <p class="text-sm font-medium text-gray-500 mb-2">Foto Barang</p>
                @if ($item->photo)
                    <img src="{{ asset('storage/images/'.$item->photo) }}" alt="Foto {{ $item->name }}" class="w-full h-auto object-cover rounded-md shadow-md">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-md">
                        <p class="text-gray-500">Tidak ada foto</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
