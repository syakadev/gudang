<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $pelangganIds = DB::table('pelanggans')->pluck('id');

        foreach (range(1, 20) as $index) {
            DB::table('transaksis')->insert([
                'pelanggan_id' => $faker->randomElement($pelangganIds),
                'tanggal_transaksi' => $faker->dateTimeBetween('-1 year', 'now'),
                'total_harga' => 0, // Will be updated by DetailTransaksiSeeder
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
