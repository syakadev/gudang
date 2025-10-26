<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        foreach (range(1, 10) as $index) {
            DB::table('warehouses')->insert([
                'name' => 'Gudang ' . $faker->city,
                'address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
