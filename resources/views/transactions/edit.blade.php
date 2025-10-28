@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Transaksi</h1>

        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Hidden user_id --}}
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Transaction Date --}}
                <div>
                    <label for="transaction_date" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                    <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    @error('transaction_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Transaction Type --}}
                <div>
                    <label for="transaction_type" class="block text-sm font-medium text-gray-700">Tipe Transaksi</label>
                    <select id="transaction_type" name="transaction_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        <option value="in" {{ old('transaction_type', $transaction->transaction_type) == 'in' ? 'selected' : '' }}>Barang Masuk</option>
                        <option value="out" {{ old('transaction_type', $transaction->transaction_type) == 'out' ? 'selected' : '' }}>Barang Keluar</option>
                    </select>
                    @error('transaction_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Customer Select (for 'out' transactions) --}}
                <div id="customer_select_wrapper" class="{{ old('transaction_type', $transaction->transaction_type) == 'out' ? '' : 'hidden' }}">
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Pelanggan</label>
                    <select id="customer_id" name="customer_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Pelanggan (Opsional)</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Supplier Select (for 'in' transactions - currently not stored on Transaction model directly) --}}
                {{-- NOTE: The Transaction model currently only stores 'customer_id'. If 'supplier_id' needs to be linked to a transaction, --}}
                {{-- the database schema (transactions table) and Transaction model need to be updated to include a 'supplier_id' column. --}}
                {{-- For now, this field is displayed but its value will not be saved to the transaction record itself by the current controller. --}}
                <div id="supplier_select_wrapper" class="{{ old('transaction_type', $transaction->transaction_type) == 'in' ? '' : 'hidden' }}">
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select id="supplier_id" name="supplier_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Supplier (Opsional)</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Shipping Address --}}
                <div class="md:col-span-2">
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                    <textarea name="shipping_address" id="shipping_address" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('shipping_address', $transaction->shipping_address) }}</textarea>
                    @error('shipping_address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Notes --}}
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('notes', $transaction->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Detail Barang</h2>
                <div class="space-y-4" id="transaction-items">
                    @forelse($transaction->transactionDetails as $index => $detail)
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 border p-4 rounded-md bg-gray-50">
                        <div class="w-full sm:w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="items[{{ $index }}][item_id]" class="item-select mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="">Pilih Barang</option>
                                @foreach($items as $index => $item)
                                    <option value="{{ $item->id }}" {{ old("items.{$index}.item_id", $detail->item_id) == $item->id ? 'selected' : '' }}>{{ $item->name }} (Stok: {{ $item->stock }})</option>
                                @endforeach
                            </select>
                            @error("items.{$index}.item_id")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full sm:w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="items[{{ $index }}][quantity]" value="{{ old("items.{$index}.quantity", $detail->quantity) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah" min="1" required>
                            @error("items.{$index}.quantity")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full sm:w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                            <input type="number" name="items[{{ $index }}][price]" value="{{ old("items.{$index}.price", $detail->price) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga" step="0.01" min="0" required>
                            @error("items.{$index}.price")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-2 sm:mt-6 self-end sm:self-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    @empty
                    {{-- Initial empty row if no transaction details exist --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 border p-4 rounded-md bg-gray-50">
                        <div class="w-full sm:w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="items[0][item_id]" class="item-select mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="">Pilih Barang</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full sm:w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="items[0][quantity]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah" min="1" required>
                        </div>
                        <div class="w-full sm:w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                            <input type="number" name="items[0][price]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga" step="0.01" min="0" required>
                        </div>
                        <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-2 sm:mt-6 self-end sm:self-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    @endforelse
                </div>
                <button type="button" id="add-item" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Tambah Barang
                </button>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
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
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transactionTypeSelect = document.getElementById('transaction_type');
        const customerSelectWrapper = document.getElementById('customer_select_wrapper');
        const supplierSelectWrapper = document.getElementById('supplier_select_wrapper');
        const customerSelect = document.getElementById('customer_id');
        const supplierSelect = document.getElementById('supplier_id');

        const addItemButton = document.getElementById('add-item');
        const transactionItemsContainer = document.getElementById('transaction-items');
        let itemIndex = {{ count($transaction->transactionDetails) > 0 ? count($transaction->transactionDetails) : 0 }};

        // Function to toggle customer/supplier select visibility
        function toggleSupplierCustomerVisibility() {
            if (transactionTypeSelect.value === 'out') {
                customerSelectWrapper.classList.remove('hidden');
                supplierSelectWrapper.classList.add('hidden');
                customerSelect.setAttribute('name', 'customer_id');
                supplierSelect.removeAttribute('name'); // Ensure supplier_id is not sent
            } else { // 'in'
                customerSelectWrapper.classList.add('hidden');
                supplierSelectWrapper.classList.remove('hidden');
                supplierSelect.setAttribute('name', 'supplier_id');
                customerSelect.removeAttribute('name'); // Ensure customer_id is not sent
            }
        }

        // Initial call on page load
        toggleSupplierCustomerVisibility();
        transactionTypeSelect.addEventListener('change', toggleSupplierCustomerVisibility);

        addItemButton.addEventListener('click', function () {
            const newItemRow = document.createElement('div');
            newItemRow.classList.add('flex', 'flex-col', 'sm:flex-row', 'items-start', 'sm:items-center', 'space-y-2', 'sm:space-y-0', 'sm:space-x-4', 'border', 'p-4', 'rounded-md', 'bg-gray-50');
            newItemRow.innerHTML = `
                <div class="w-full sm:w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Barang</label>
                    <select name="items[${itemIndex}][item_id]" class="item-select mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        <option value="">Pilih Barang</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} (Stok: {{ $item->stock }})</option>
                        @endforeach
                    </select>
                </div>
            `;
            // Add quantity and price inputs, and remove button
            newItemRow.innerHTML += `
                <div class="w-full sm:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="items[${itemIndex}][quantity]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah" min="1" required>
                </div>
                <div class="w-full sm:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Harga Satuan</label>
                    <input type="number" name="items[${itemIndex}][price]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga" step="0.01" min="0" required>
                </div>
                <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-2 sm:mt-6 self-end sm:self-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            transactionItemsContainer.appendChild(newItemRow);
            itemIndex++;
        });

        transactionItemsContainer.addEventListener('click', function (e) {
            if (e.target.closest('.remove-item')) {
                e.target.closest('.flex').remove();
            }
        });
    });
</script>
@endpush


