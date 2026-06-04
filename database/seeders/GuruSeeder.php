<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nik' => '1234567890123456',
            'name' => 'Admin Guru',
            'email' => 'guru@example.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
            'is_active' => true,
        ]);
    }
}