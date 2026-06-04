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
        Schema::create('siswa_diterima', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->string('nama_lengkap');
            $table->string('nik', 16);
            $table->string('nisn', 10);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('asal_sekolah');
            $table->date('tanggal_diterima');
            $table->enum('status_seleksi', ['diterima', 'menunggu', 'proses'])->default('diterima');
            $table->timestamps();
            
            // Hapus foreign key untuk sementara agar tidak error
            // $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_diterima');
    }
};
