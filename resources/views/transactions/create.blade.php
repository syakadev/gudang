@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container mx-auto">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Transaksi</h1>

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="hidden" name="transaction_type" id="transaction_type" value="out"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <div id="customer-div">
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">Pelanggan</label>
                    <select id="customer_id" name="customer_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="transaction_date" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                    <input type="date" id="transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900">Detail Barang</h2>
                <div class="mt-4 space-y-4" id="transaction-items">
                    <div class="flex items-center space-x-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="items[0][item_id]" class="item-select mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option>Pilih Barang</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" name="items[0][quantity]" class="quantity-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah" value="1">
                        </div>
                        <div class="w-1/4">
                            <label class="block text-sm font-medium text-gray-700">Harga</label>
                            <input readonly type="number" name="items[0][price]" class="price-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga" value="{{ old('items.0.price', $items[0]->price ?? '') }}">
                        </div>
                        <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                <button type="button" id="add-item" class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                    Tambah Barang
                </button>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                    <textarea id="shipping_address" name="shipping_address" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>
            </div>

            <div class="mt-6">
                <label for="total_price" class="block text-sm font-medium text-gray-700">Total Harga</label>
                <input type="number" id="total_price" name="total_price" readonly class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-gray-100 rounded-md shadow-sm sm:text-sm">
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div class="mt-8 flex justify-end">
                <a href="{{ route('transactions.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300 mr-4">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const transactionType = document.getElementById('transaction_type');
        const supplierDiv = document.getElementById('supplier-div');
        const customerDiv = document.getElementById('customer-div');
        const transactionItems = document.getElementById('transaction-items');
        const addItemButton = document.getElementById('add-item');
        const totalPriceInput = document.getElementById('total_price');
        let itemIndex = 1;

        const itemOptions = `@foreach($items as $item)
<option value="{{ $item->id }}" data-price="{{ $item->price }}">{{ $item->name }}</option>
@endforeach`;

        function toggleSupplierCustomer() {
            if (transactionType.value === 'in') {
                supplierDiv.style.display = 'block';
                customerDiv.style.display = 'none';
            } else {
                supplierDiv.style.display = 'none';
                customerDiv.style.display = 'block';
            }
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.price-input').forEach((priceInput, index) => {
                const quantityInput = document.querySelectorAll('.quantity-input')[index];
                const price = parseFloat(priceInput.value) || 0;
                const quantity = parseInt(quantityInput.value) || 0;
                total += price * quantity;
            });
            totalPriceInput.value = total;
        }

        function updatePrice(itemSelect) {
            const selectedOption = itemSelect.options[itemSelect.selectedIndex];
            const price = selectedOption.dataset.price;
            const priceInput = itemSelect.closest('.flex').querySelector('.price-input');
            priceInput.value = price;
            calculateTotal();
        }

        transactionType.addEventListener('change', toggleSupplierCustomer);

        addItemButton.addEventListener('click', function () {
            const newItemRow = document.createElement('div');
            newItemRow.classList.add('flex', 'items-center', 'space-x-4', 'mt-4');
            newItemRow.innerHTML = `
                <div class="w-1/2">
                    <select name="items[${itemIndex}][item_id]" class="item-select mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option>Pilih Barang</option>
                        ${itemOptions}
                    </select>
                </div>
                <div class="w-1/4">
                    <input type="number" name="items[${itemIndex}][quantity]" class="quantity-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jumlah" value="1">
                </div>
                <div class="w-1/4">
                    <input readonly type="number" name="items[${itemIndex}][price]" class="price-input mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Harga">
                </div>
                <button type="button" class="remove-item text-red-600 hover:text-red-900 mt-6">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            transactionItems.appendChild(newItemRow);
            itemIndex++;
        });

        transactionItems.addEventListener('click', function (e) {
            if (e.target.closest('.remove-item')) {
                e.target.closest('.flex').remove();
                calculateTotal();
            }
        });

        transactionItems.addEventListener('change', function(e) {
            if (e.target.classList.contains('item-select')) {
                updatePrice(e.target);
            }
            if (e.target.classList.contains('quantity-input')) {
                calculateTotal();
            }
        });

        transactionItems.addEventListener('input', function(e) {
            if (e.target.classList.contains('price-input') || e.target.classList.contains('quantity-input')) {
                calculateTotal();
            }
        });

        // Initial setup
        toggleSupplierCustomer();
        // Set initial price for the first item
        const initialItemSelect = document.querySelector('.item-select');
        if (initialItemSelect.options.length > 1) {
            initialItemSelect.selectedIndex = 1; // Select the first item
            updatePrice(initialItemSelect);
        } else {
            calculateTotal();
        }
    });
</script>
@endpush
@endsection
