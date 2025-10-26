<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $gudangIds = DB::table('gudangs')->pluck('id');
        $supplierIds = DB::table('suppliers')->pluck('id');

        foreach (range(1, 50) as $index) {
            DB::table('barangs')->insert([
                'gudang_id' => $faker->randomElement($gudangIds),
                'supplier_id' => $faker->randomElement($supplierIds),
                'nama_barang' => $faker->words(3, true),
                'stok' => $faker->numberBetween(10, 100),
                'harga' => $faker->numberBetween(10000, 1000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
