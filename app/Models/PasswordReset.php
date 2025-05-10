<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'email',
        'token'
    ];

    public static function getValidToken($token)
    {
        return static::where('token', $token)
            ->where('created_at', '>=', now()->subHours(24))
            ->first();
    }
}
