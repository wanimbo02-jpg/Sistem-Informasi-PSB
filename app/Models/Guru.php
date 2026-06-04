<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama_lengkap',
        'nip',
        'email',
        'telepon',
        'status',
        'mata_pelajaran',
        'foto',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'tahun_masuk',
        'jenis_kelamin',
        'alamat'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_masuk' => 'integer',
        'status' => 'string',
        'jenis_kelamin' => 'string'
    ];
}
