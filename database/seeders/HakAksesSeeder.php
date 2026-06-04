<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HakAkses;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update hak akses for user
        HakAkses::updateOrCreate(
            ['nama_modul' => 'user'],
            [
                'status' => 'aktif',
                'keterangan' => 'Hak akses untuk login dan register siswa'
            ]
        );

        // Create or update hak akses for guru
        HakAkses::updateOrCreate(
            ['nama_modul' => 'guru'],
            [
                'status' => 'aktif',
                'keterangan' => 'Hak akses untuk Dashboard Guru'
            ]
        );
    }
}
