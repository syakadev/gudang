<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $transaksiIds = DB::table('transaksis')->pluck('id');
        $barangIds = DB::table('barangs')->pluck('id', 'harga');

        foreach ($transaksiIds as $transaksiId) {
            $totalHarga = 0;
            foreach (range(1, $faker->numberBetween(1, 5)) as $index) {
                $barangId = $faker->randomElement($barangIds->keys());
                $harga = $barangIds[$barangId];
                $jumlah = $faker->numberBetween(1, 10);
                $subtotal = $harga * $jumlah;
                $totalHarga += $subtotal;

                DB::table('detail_transaksis')->insert([
                    'transaksi_id' => $transaksiId,
                    'barang_id' => $barangId,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            DB::table('transaksis')->where('id', $transaksiId)->update(['total_harga' => $totalHarga]);
        }
    }
}
