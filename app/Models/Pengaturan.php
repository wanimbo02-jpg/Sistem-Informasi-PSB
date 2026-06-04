<?php
// app/Models/Pengaturan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     * Penting: tentukan nama tabel yang benar (tanpa 's' di akhir)
     *
     * @var string
     */
    protected $table = 'pengaturan'; // Gunakan 'pengaturan' bukan 'pengaturans'

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'keterangan'
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Scope untuk mengambil pengaturan berdasarkan key.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeKey($query, $key)
    {
        return $query->where('key', $key);
    }

    /**
     * Mendapatkan nilai pengaturan dengan default value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Mendapatkan semua pengaturan dalam bentuk array key-value.
     *
     * @return array
     */
    public static function getAllAsArray()
    {
        return self::pluck('value', 'key')->toArray();
    }
}