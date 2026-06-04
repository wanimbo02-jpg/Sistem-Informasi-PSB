<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'berkas_pendaftaran';

    protected $fillable = [
        'pendaftaran_id',
        'file_kk',
        'file_ijazah',
        'file_rapor',
        'file_akte',
        'file_foto',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}