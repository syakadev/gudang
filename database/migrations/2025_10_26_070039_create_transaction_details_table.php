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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel transaksi
            $table->foreignId('transaksi_id')
                  ->constrained('transaksi')
                  ->onDelete('cascade'); // Jika transaksi dihapus, detailnya ikut terhapus

            // Foreign key ke tabel barang
            $table->foreignId('barang_id')
                  ->constrained('barang')
                  ->onDelete('restrict'); // Jangan hapus barang jika ada di detail transaksi

            $table->unsignedInteger('jumlah_barang');

            // harga barang total semua barang
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
