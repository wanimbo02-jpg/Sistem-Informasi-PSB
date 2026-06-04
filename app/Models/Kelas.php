<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'wali_kelas',
        'semester',
        'total_siswa',
        'laki_laki',
        'perempuan',
        'deskripsi'
    ];

    protected $casts = [
        'total_siswa' => 'integer',
        'laki_laki' => 'integer',
        'perempuan' => 'integer'
    ];

    // Relasi ke siswa (jika ada tabel siswa)
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Scope untuk jurusan IPA
    public function scopeIPA($query)
    {
        return $query->where('jurusan', 'IPA');
    }

    // Scope untuk jurusan IPS
    public function scopeIPS($query)
    {
        return $query->where('jurusan', 'IPS');
    }
}
