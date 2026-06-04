<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nisn', 'nik', 'nama_lengkap', 'nama_panggilan',
        'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama',
        'kewarganegaraan', 'anak_ke', 'jumlah_saudara', 'alamat',
        'rt_rw', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota',
        'provinsi', 'kode_pos', 'telepon_rumah', 'handphone', 'email',
        'asal_sekolah', 'npsn_sekolah', 'alamat_sekolah', 'tahun_lulus',
        'nomor_ijazah', 'nomor_skhun'
    ];

    protected $casts = [    
        'tanggal_lahir' => 'date',
        'anak_ke' => 'integer',
        'jumlah_saudara' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }
}
