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
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            $table->string('judul_utama')->default('STRUKTUR ORGANISASI')->after('id');
            $table->string('sub_judul')->default('SMA NEGERI KARUBAGA')->after('judul_utama');
            $table->text('teks_bawah_foto')->nullable()->after('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            $table->dropColumn(['judul_utama', 'sub_judul', 'teks_bawah_foto']);
        });
    }
};
