<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'ADMIN',
        ]);

        // 🔹 Tamu
        User::create([
            'name' => 'Dhias',
            'email' => 'dhias@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'TAMU',
        ]);
    }
}
