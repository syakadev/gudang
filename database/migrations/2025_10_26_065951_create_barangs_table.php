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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->decimal('harga', 15, 2); // 15 digit total, 2 di belakang koma
            $table->string('kategori');
            $table->string('satuan'); // misal: 'pcs', 'kg', 'liter'
            $table->unsignedInteger('stok')->default(0);

            // Relasi 'menyimpan' (N-to-1 dengan Gudang)
            $table->foreignId('gudang_id')
                ->constrained('gudang')
                  ->onDelete('cascade'); // Jika gudang dihapus, barang di dalamnya ikut terhapus

            // Relasi 'menyediakan' (N-to-1 dengan Supplier)
            $table->foreignId('supplier_id')
                ->constrained('supplier')
                  ->onDelete('restrict'); // Jangan hapus supplier jika masih punya barang

            // Siapa user manager gudang yang mengatur barang
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                  ->onDelete('set null'); // Jika user dihapus, gudang tidak terhapus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
