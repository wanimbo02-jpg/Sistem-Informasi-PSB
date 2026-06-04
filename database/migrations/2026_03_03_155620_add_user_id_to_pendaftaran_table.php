<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPendaftaranTable extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Cek dulu apakah kolom sudah ada
            if (!Schema::hasColumn('pendaftaran', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id');
                // atau jika bukan foreignId:
                // $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftaran', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
}