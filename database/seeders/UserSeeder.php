<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin PPDB',
            'email' => 'admin@ppdb.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_hp' => '081234567890',
            'status' => 'aktif'
        ]);

        // Create Sample Siswa
        $siswa = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@siswa.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'no_hp' => '081298765432',
            'alamat' => 'Jl. Pendidikan No. 1, Karubaga',
            'status' => 'aktif'
        ]);

        // Create Siswa Data
        Siswa::create([
            'user_id' => $siswa->id,
            'nisn' => '1234567890',
            'nik' => '9876543210',
            'tempat_lahir' => 'Karubaga',
            'tanggal_lahir' => '2008-05-15',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'asal_sekolah' => 'SMP Negeri 1 Karubaga',
            'nama_ayah' => 'Supardi',
            'pekerjaan_ayah' => 'Petani',
            'nama_ibu' => 'Siti Aminah',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'no_hp_ortu' => '081312345678',
            'alamat_ortu' => 'Jl. Pendidikan No. 1, Karubaga',
        ]);
    }
}
