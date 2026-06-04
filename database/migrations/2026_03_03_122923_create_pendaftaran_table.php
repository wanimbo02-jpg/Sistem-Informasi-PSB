<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            // Data Pribadi Siswa
            $table->string('nisn', 10);
            $table->string('nik', 16);
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->text('alamat');
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan_desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('handphone');
            $table->string('email')->nullable();
            $table->string('asal_sekolah');
            $table->year('tahun_lulus');
            
            // Data Pendaftaran
            $table->enum('jalur_pendaftaran', ['umum', 'prestasi', 'afirmasi', 'pindah_tugas']);
            $table->enum('jurusan1', ['IPA', 'IPS', 'BAHASA']);
            $table->enum('jurusan2', ['IPA', 'IPS', 'BAHASA'])->nullable();
            
            // Data Ayah
            $table->string('nama_ayah');
            $table->string('nik_ayah', 16)->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('telepon_ayah')->nullable();
            
            // Data Ibu
            $table->string('nama_ibu');
            $table->string('nik_ibu', 16)->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('telepon_ibu')->nullable();
            
            // Data Wali (Opsional)
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            
            // Status Pendaftaran
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            
            // Timestamps
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};