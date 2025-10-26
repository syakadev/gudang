<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->text('catatan')->nullable();
            $table->dateTime('tanggal');

            // 'jumlah' di ERD saya asumsikan sebagai total harga transaksi
            $table->decimal('total_harga', 15, 2);

            $table->string('alamat_pengiriman')->nullable();
            $table->enum('jenis_transaksi', ['masuk', 'keluar']); //  'masuk', 'keluar'

            // Relasi 'mencatat' (N-to-1 dengan User)
            $table->foreignId('user_id')
                ->constrained('users')
                  ->onDelete('restrict'); // Jangan hapus user jika pernah mencatat transaksi

            // Relasi 'melakukan' (N-to-1 dengan Pelanggan)
            $table->foreignId('pelanggan_id')
                ->constrained('pelanggan')
                  ->onDelete('restrict'); // Jangan hapus pelanggan jika punya riwayat transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
