<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_utama')->default('STRUKTUR ORGANISASI'); // Judul utama di atas struktur
            $table->string('sub_judul')->default('SMA NEGERI KARUBAGA'); // Sub judul di bawah judul utama
            $table->string('jabatan');          // Contoh: KEPALA SEKOLAH, SEKRETARIS 1
            $table->string('nama');             // Contoh: Dra. Maria Kogoya, M.Pd
            $table->string('foto')->nullable(); // Path foto
            $table->integer('urutan')->default(0); // 0 = paling atas (kepala sekolah)
            $table->text('teks_bawah_foto')->nullable(); // Teks tambahan di bawah foto (NIP, dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasi');
    }
};
