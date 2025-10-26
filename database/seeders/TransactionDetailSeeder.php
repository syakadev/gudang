<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $transactionIds = DB::table('transactions')->pluck('id');
        $itemIds = DB::table('items')->pluck('id', 'price');

        foreach ($transactionIds as $transactionId) {
            $totalPrice = 0;
            foreach (range(1, $faker->numberBetween(1, 5)) as $index) {
                $itemId = $faker->randomElement($itemIds->keys());
                $price = $itemIds[$itemId];
                $quantity = $faker->numberBetween(1, 10);
                $subtotal = $price * $quantity;
                $totalPrice += $subtotal;

                DB::table('transaction_details')->insert([
                    'transaction_id' => $transactionId,
                    'item_id' => $itemId,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            DB::table('transactions')->where('id', $transactionId)->update(['total_price' => $totalPrice]);
        }
    }
}
