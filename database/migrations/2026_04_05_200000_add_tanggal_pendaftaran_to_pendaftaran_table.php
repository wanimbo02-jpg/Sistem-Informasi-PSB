<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->date('tanggal_pendaftaran')->nullable()->after('tahun_lulus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('tanggal_pendaftaran');
        });
    }
};
