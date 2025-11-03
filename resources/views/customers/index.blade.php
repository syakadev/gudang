
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


        <!-- Search and Filter -->
        <div class="mb-4">
            <input id="searchInput" type="text" placeholder="Cari barang..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>


        @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Customers Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white" id="dataTable">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($customers as $customer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ++$i }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $customer->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $customer->phone_number ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('customers.show', $customer->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="ml-4 text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Anda yakin ingin menghapus pelanggan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Tidak ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
                        <p id="noResult" class="no-result text-center" style="display:none; padding: 1cm">Tidak ada hasil ditemukan</p>

        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@push('scripts')
<script>
   const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('dataTable');
    const rows = table.getElementsByTagName('tr');
    const noResult = document.getElementById('noResult');

    searchInput.addEventListener('keyup', function() {
      const filter = this.value.toLowerCase();
      let visibleCount = 0;

      for (let i = 1; i < rows.length; i++) { // mulai dari 1 agar skip header
        const rowText = rows[i].textContent.toLowerCase();
        if (rowText.indexOf(filter) > -1) {
          rows[i].style.display = '';
          visibleCount++;
        } else {
          rows[i].style.display = 'none';
        }
      }

      // tampilkan pesan jika tidak ada hasil
      noResult.style.display = visibleCount === 0 ? '' : 'none';
    });
  </script>
@endpush
@endsection
