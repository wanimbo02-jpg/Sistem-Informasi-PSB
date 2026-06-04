<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
