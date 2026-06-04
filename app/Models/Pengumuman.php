<?php
// app/Models/Pengumuman.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'pengumuman';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_pengumuman',
        'judul',
        'sub_judul',
        'isi',           // Gunakan 'isi' jika di database menggunakan kolom 'isi'
        'konten',        // Atau gunakan 'konten' jika di database menggunakan kolom 'konten'
        'file',
        'tahun_ajaran',
        'penting',
        'aktif',
        'tanggal_publish',      // Jika menggunakan 'tanggal_publish'
        'tanggal_publikasi',     // Jika menggunakan 'tanggal_publikasi'
        'created_by',
        'updated_by'
    ];

    /**
     * Atribut yang harus di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'penting' => 'boolean',
        'aktif' => 'boolean',
        'tanggal_publish' => 'datetime',
        'tanggal_publikasi' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Atribut tanggal yang harus diperlakukan sebagai instance Carbon.
     *
     * @var array
     */
    protected $dates = [
        'tanggal_publish',
        'tanggal_publikasi',
        'created_at',
        'updated_at'
    ];

    /**
     * Scope untuk mengambil pengumuman yang aktif.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    /**
     * Scope untuk mengambil pengumuman yang penting.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePenting($query)
    {
        return $query->where('penting', true);
    }

    /**
     * Scope untuk mengambil pengumuman yang sudah dipublikasi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerpublikasi($query)
    {
        $tanggalKolom = $this->getTanggalPublikasiColumn();
        return $query->where($tanggalKolom, '<=', now());
    }

    /**
     * Mendapatkan nama kolom tanggal publikasi yang digunakan.
     *
     * @return string
     */
    protected function getTanggalPublikasiColumn()
    {
        if (in_array('tanggal_publish', $this->fillable)) {
            return 'tanggal_publish';
        }
        return 'tanggal_publikasi';
    }

    /**
     * Accessor untuk mendapatkan konten dengan format yang rapi.
     *
     * @return string
     */
    public function getKontenFormattedAttribute()
    {
        $konten = $this->konten ?? $this->isi ?? '';
        return nl2br(e($konten));
    }

    /**
     * Accessor untuk mendapatkan judul dengan limit karakter.
     *
     * @param int $limit
     * @return string
     */
    public function getJudulLimitedAttribute($limit = 50)
    {
        return strlen($this->judul) > $limit 
            ? substr($this->judul, 0, $limit) . '...' 
            : $this->judul;
    }

    /**
     * Accessor untuk mendapatkan status dalam format badge.
     *
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        if (!$this->aktif) {
            return '<span class="badge bg-secondary">Tidak Aktif</span>';
        }
        
        if ($this->penting) {
            return '<span class="badge bg-danger">Penting</span>';
        }
        
        return '<span class="badge bg-success">Aktif</span>';
    }

    /**
     * Accessor untuk mendapatkan tanggal publikasi dalam format yang mudah dibaca.
     *
     * @return string
     */
    public function getTanggalPublikasiFormattedAttribute()
    {
        $tanggal = $this->tanggal_publish ?? $this->tanggal_publikasi ?? $this->created_at;
        
        if ($tanggal) {
            return $tanggal->format('d M Y H:i');
        }
        
        return '-';
    }

    /**
     * Mutator untuk memastikan konten tidak kosong.
     *
     * @param string $value
     * @return void
     */
    public function setIsiAttribute($value)
    {
        $this->attributes['isi'] = $value ?: '';
    }

    /**
     * Mutator untuk memastikan konten tidak kosong.
     *
     * @param string $value
     * @return void
     */
    public function setKontenAttribute($value)
    {
        $this->attributes['konten'] = $value ?: '';
    }
}