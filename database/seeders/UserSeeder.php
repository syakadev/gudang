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
            'email_verified_at' => now(), // Langsung verifikasi email
            'password' => Hash::make('12345678'), // Password: 12345678
        ]);

        // Anda bisa menambahkan user lain di sini jika perlu
        // User::factory(10)->create();
    }
}