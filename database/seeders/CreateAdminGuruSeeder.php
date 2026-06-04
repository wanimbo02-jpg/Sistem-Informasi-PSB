<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat admin jika belum ada
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Administrator',
                'nip' => '123456789',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'aktif',
            ]);
            echo "Admin created: " . $admin->name . "\n";
        } else {
            echo "Admin exists: " . $admin->name . "\n";
        }

        // Buat guru jika belum ada
        $guru = User::where('role', 'guru')->first();
        if (!$guru) {
            $guru = User::create([
                'name' => 'Guru BK',
                'nip' => '987654321',
                'email' => 'guru@example.com',
                'password' => Hash::make('password'),
                'role' => 'guru',
                'status' => 'aktif',
            ]);
            echo "Guru created: " . $guru->name . "\n";
        } else {
            echo "Guru exists: " . $guru->name . "\n";
        }
    }
}
