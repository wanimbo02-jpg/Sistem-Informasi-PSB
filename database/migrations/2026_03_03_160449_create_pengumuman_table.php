<?php
// database/migrations/2024_01_01_000003_create_pengumuman_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pengumuman')) {
            Schema::create('pengumuman', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->text('isi')->nullable(); // atau 'konten' tergantung preferensi
                $table->boolean('penting')->default(false);
                $table->boolean('aktif')->default(true);
                $table->timestamp('tanggal_publikasi')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->timestamps();
                
                // Foreign keys (jika diperlukan)
                // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
                // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
                
                // Index untuk optimasi query
                $table->index('aktif');
                $table->index('penting');
                $table->index('tanggal_publikasi');
                $table->index('created_at');
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
        Schema::dropIfExists('pengumuman');
    }
}