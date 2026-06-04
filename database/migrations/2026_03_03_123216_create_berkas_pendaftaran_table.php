<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('berkas_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran')->onDelete('cascade');
            $table->string('file_kk')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_rapor')->nullable();
            $table->string('file_akte')->nullable();
            $table->string('file_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('berkas_pendaftaran');
    }
};