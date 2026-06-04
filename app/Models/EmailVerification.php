<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'expires_at',
        'verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified' => 'boolean',
    ];

    /**
     * Generate verification code
     */
    public static function generateCode()
    {
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Create verification for email
     */
    public static function createForEmail($email)
    {
        // Delete any existing verification for this email
        self::where('email', $email)->delete();
        
        return self::create([
            'email' => $email,
            'code' => self::generateCode(),
            'expires_at' => Carbon::now()->addMinutes(15), // Expire in 15 minutes
        ]);
    }

    /**
     * Check if code is valid
     */
    public function isValid()
    {
        return !$this->verified && $this->expires_at->isFuture();
    }

    /**
     * Mark as verified
     */
    public function markAsVerified()
    {
        $this->verified = true;
        $this->save();
    }

    /**
     * Find valid verification by email and code
     */
    public static function findValid($email, $code)
    {
        return self::where('email', $email)
            ->where('code', $code)
            ->where('verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }
}
