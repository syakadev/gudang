<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        foreach (range(1, 10) as $index) {
            DB::table('customers')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
