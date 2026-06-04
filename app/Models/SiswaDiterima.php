<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaDiterima extends Model
{
    use HasFactory;

    protected $table = 'siswa_diterima';

    protected $fillable = [
        'pendaftaran_id',
        'nama_lengkap',
        'nik',
        'nisn',
        'jenis_kelamin',
        'asal_sekolah',
        'kelas',
        'tanggal_diterima',
        'status_seleksi'
    ];

    protected $dates = [
        'tanggal_diterima',
        'created_at',
        'updated_at'
    ];

    // Relasi ke pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
