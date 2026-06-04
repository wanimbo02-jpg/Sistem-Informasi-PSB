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
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('provinsi_domisili')->nullable();
            $table->string('kabupaten_domisili')->nullable();
            $table->string('nama_kabupaten_domisili')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn(['provinsi_domisili', 'kabupaten_domisili', 'nama_kabupaten_domisili']);
        });
    }
};
