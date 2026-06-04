<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrangTua extends Model
{
    use HasFactory;

    protected $table = 'data_orang_tua';

    protected $fillable = [
        'user_id',
        'nik_ayah',
        'nama_ayah',
        'pekerjaan_ayah',
        'pendidikan_ayah',
        'no_hp_ayah',
        'nik_ibu',
        'nama_ibu',
        'pekerjaan_ibu',
        'pendidikan_ibu',
        'no_hp_ibu',
        'nik_wali',
        'nama_wali',
        'pekerjaan_wali',
        'penghasilan_ortu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}