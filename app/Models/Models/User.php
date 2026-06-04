<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'role',
        'progress_data',
        'is_active',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Update progress data user
     */
    public function updateProgress()
    {
        $progress = 0;
        
        if ($this->nisn) $progress += 10;
        if ($this->tempat_lahir) $progress += 10;
        if ($this->tanggal_lahir) $progress += 10;
        if ($this->jenis_kelamin) $progress += 10;
        if ($this->alamat) $progress += 10;
        if ($this->no_hp) $progress += 10;
        
        // CEK DENGAM AMAN apakah sudah mengisi data pendaftaran
        if (method_exists($this, 'pendaftaran') && $this->pendaftaran()->exists()) {
            $progress += 40;
        } else {
            // Cek manual ke database jika relasi bermasalah
            $pendaftaranExists = \DB::table('pendaftaran')
                ->where('user_id', $this->id)
                ->exists();
            
            if ($pendaftaranExists) {
                $progress += 40;
            }
        }
        
        $this->progress_data = $progress;
        $this->save();
        
        return $progress;
    }

    /**
     * Relasi ke pendaftaran
     */
    public function pendaftaran()
    {
        // Pastikan nama tabel dan foreign key benar
        return $this->hasOne(Pendaftaran::class, 'user_id', 'id');
    }
}