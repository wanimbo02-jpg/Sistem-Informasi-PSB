<?php
// app/Models/Informasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     * Tetapkan nama tabel yang benar (tanpa 's' di akhir)
     *
     * @var string
     */
    protected $table = 'informasis'; // Penting: tentukan nama tabel yang benar

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'konten',
        'status'
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Scope untuk mengambil informasi yang aktif.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan urutan.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    /**
     * Scope untuk mengambil informasi dengan status aktif.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatusAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}