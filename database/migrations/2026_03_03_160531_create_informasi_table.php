<?php
// database/migrations/2024_01_01_000004_create_informasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('informasi')) {
            Schema::create('informasi', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('konten');
                $table->string('icon')->default('info-circle');
                $table->boolean('aktif')->default(true);
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                // Index
                $table->index('aktif');
                $table->index('urutan');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi');
    }
}