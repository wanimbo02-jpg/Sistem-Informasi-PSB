<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'nama_mapel',
        'code_mapel',
        'nama_pengajar',
        'nip_pengajar',
        'foto_pengajar',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Scope untuk mata pelajaran aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // Scope untuk mata pelajaran tidak aktif
    public function scopeTidakAktif($query)
    {
        return $query->where('status', 'tidak aktif');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'aktif' 
            ? '<span class="badge bg-success">Aktif</span>'
            : '<span class="badge bg-danger">Tidak Aktif</span>';
    }

    // Accessor untuk foto URL
    public function getFotoUrlAttribute()
    {
        if ($this->foto_pengajar) {
            return asset('uploads/foto-pengajar/' . $this->foto_pengajar);
        }
        return asset('images/default-avatar.png');
    }
}
