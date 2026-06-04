<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('telepon');
            $table->enum('status', ['aktif', 'tidak-aktif'])->default('aktif');
            $table->string('mata_pelajaran');
            $table->string('foto')->nullable();
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir');
            $table->integer('tahun_masuk');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
