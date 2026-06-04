<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangtuaWali extends Model
{
    use HasFactory;

    protected $table = 'orangtua_walis';

    protected $fillable = ['user_id', 'no_hp', 'pekerjaan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
