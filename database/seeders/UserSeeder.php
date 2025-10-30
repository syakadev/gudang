<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'Admin',
        ]);

        // Membuat user warehouse manager
        User::create([
            'name' => 'Warehouse Manager',
            'email' => 'warehouse@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'Warehouse Manager',
        ]);

        // Membuat user cashier
        User::create([
            'name' => 'Cashier',
            'email' => 'cashier@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'role' => 'Cashier',
        ]);
    }
}