<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'message',
        'status',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'unread' => '<span class="badge bg-danger">Belum Dibaca</span>',
            'read' => '<span class="badge bg-warning">Dibaca</span>',
            'replied' => '<span class="badge bg-success">Dibalas</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark as replied
     */
    public function markAsReplied($reply = null)
    {
        $this->update([
            'status' => 'replied',
            'admin_reply' => $reply,
            'replied_at' => now(),
        ]);
    }

    /**
     * Scope unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope read messages
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Scope replied messages
     */
    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }
}
