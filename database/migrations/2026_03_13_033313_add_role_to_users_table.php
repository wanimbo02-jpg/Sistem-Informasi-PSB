<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Kolom role sudah ada di migration 2026_02_27_130707_add_role_nohp_status_to_users_table
        // Tidak perlu ditambahkan lagi
    }

    public function down()
    {
        // Tidak ada yang dihapus
    }
};