<?php
// app/Models/Pendaftaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'nisn',
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'anak_ke',
        'jumlah_saudara',
        'alamat',
        'rt_rw',
        'kelurahan_desa',
        'kecamatan',
        'kabupaten_kota',
        'provinsi',
        'kode_pos',
        'handphone',
        'email',
        'asal_sekolah',
        'tahun_lulus',
        'tanggal_pendaftaran',
        'foto',
        'jalur_pendaftaran',
        'jurusan1',
        'jurusan2',
        'nama_ayah',
        'nik_ayah',
        'pekerjaan_ayah',
        'pendidikan_ayah',
        'penghasilan_ayah',
        'telepon_ayah',
        'nama_ibu',
        'nik_ibu',
        'pekerjaan_ibu',
        'pendidikan_ibu',
        'penghasilan_ibu',
        'telepon_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'telepon_wali',
        'no_hp_ortu',
        'provinsi_domisili',
        'kabupaten_domisili',
        'nama_kabupaten_domisili',
        'status',
        'kelas',
        'catatan_admin'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_lulus' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function berkas()
    {
        return $this->hasOne(BerkasPendaftaran::class, 'pendaftaran_id');
    }

    public function getFotoAttribute()
    {
        // Cek apakah ada foto di tabel pendaftaran
        if ($this->attributes['foto'] ?? null) {
            return $this->attributes['foto'];
        }
        
        // Jika tidak ada, cek di tabel berkas_pendaftaran
        $berkas = $this->berkas;
        if ($berkas && $berkas->file_foto) {
            return $berkas->file_foto;
        }
        
        return null;
    }
}