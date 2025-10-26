<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $customerIds = DB::table('customers')->pluck('id');
        $userIds = DB::table('users')->pluck('id');

        foreach (range(1, 20) as $index) {
            DB::table('transactions')->insert([
                'notes' => $faker->sentence,
                'transaction_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'total_price' => 0, // Will be updated by TransactionDetailSeeder
                'shipping_address' => $faker->address,
                'transaction_type' => $faker->randomElement(['in', 'out']),
                'user_id' => $faker->randomElement($userIds),
                'customer_id' => $faker->randomElement($customerIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
