<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasFactory;

    protected $table = 'struktur_organisasi';

    protected $fillable = [
        'judul_utama',
        'sub_judul',
        'jabatan',
        'nama',
        'foto',
        'urutan',
        'teks_bawah_foto',
    ];
}
