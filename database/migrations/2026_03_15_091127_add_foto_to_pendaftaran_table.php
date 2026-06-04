<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kolom foto sudah ada di migration 2026_03_12_154433_add_foto_to_pendaftaran_table
        // Tidak perlu ditambahkan lagi
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada yang dihapus
    }
};
