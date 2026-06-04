<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('kewarganegaraan')->default('WNI');
            $table->integer('anak_ke')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->text('alamat');
            $table->string('rt_rw')->nullable();
            $table->string('kelurahan_desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('telepon_rumah')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->nullable();
            $table->string('asal_sekolah');
            $table->string('npsn_sekolah')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('tahun_lulus');
            $table->string('nomor_ijazah')->nullable();
            $table->string('nomor_skhun')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
