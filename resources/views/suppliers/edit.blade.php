@extends('layouts.app')

@section('title', 'Ubah Data Supplier')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800">Ubah Data Supplier</h1>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="mb-4 px-4 py-3 bg-red-100 text-red-800 border border-red-300 rounded-lg">
                    <p class="font-bold">Oops! Ada beberapa masalah dengan input Anda.</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Kontak</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $supplier->phone_number) }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="address" rows="4" required
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('address', $supplier->address) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('suppliers.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Batal
                    </a>
                    <button type="submit" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
