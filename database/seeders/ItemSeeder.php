<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $warehouseIds = DB::table('warehouses')->pluck('id');
        $supplierIds = DB::table('suppliers')->pluck('id');

        foreach (range(1, 50) as $index) {
            DB::table('items')->insert([
                'warehouse_id' => $faker->randomElement($warehouseIds),
                'supplier_id' => $faker->randomElement($supplierIds),
                'name' => $faker->words(3, true),
                'stock' => $faker->numberBetween(10, 100),
                'price' => $faker->numberBetween(10000, 1000000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
