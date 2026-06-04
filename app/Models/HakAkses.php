<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakAkses extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_modul',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Cek apakah modul aktif
     */
    public static function isModulAktif($namaModul)
    {
        $hakAkses = self::where('nama_modul', $namaModul)->first();
        return $hakAkses && $hakAkses->status === 'aktif';
    }

    /**
     * Aktifkan modul
     */
    public static function aktifkanModul($namaModul)
    {
        return self::updateOrCreate(
            ['nama_modul' => $namaModul],
            ['status' => 'aktif']
        );
    }

    /**
     * Nonaktifkan modul
     */
    public static function nonaktifkanModul($namaModul)
    {
        return self::updateOrCreate(
            ['nama_modul' => $namaModul],
            ['status' => 'nonaktif']
        );
    }
}
