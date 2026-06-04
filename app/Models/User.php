<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik', 'nip', 'name', 'email', 'password', 'role', 'is_active', 'kelas', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'no_telepon', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'penghasilan_ayah', 'penghasilan_ibu', 'status', 'tahun_ajaran', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relasi ke siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    // Relasi ke pendaftaran
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    // Cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    public function isGuru()
    {
        return $this->role === 'guru';
    }

    public function isOrtu()
    {
        return $this->role === 'orangtua';
    }
}