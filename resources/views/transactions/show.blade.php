@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
            <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm font-medium text-gray-500">ID Transaksi</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transaction->id }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tanggal</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transaction->created_at->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Tipe</p>
                <p class="text-lg font-semibold text-gray-800">{{ $transaction->type == 'in' ? 'Barang Masuk' : 'Barang Keluar' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total</p>
                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</p>
            </div>
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-4">Detail Barang</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($transaction->details as $index => $detail)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detail->item->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $detail->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($detail->price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900">Rp {{ number_format($detail->quantity * $detail->price, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
