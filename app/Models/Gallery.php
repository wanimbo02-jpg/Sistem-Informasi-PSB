<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'event_date',
        'event_category',
        'location',
        'is_active',
        'views',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
        'views' => 'integer',
    ];

    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 100);
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d F Y');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
