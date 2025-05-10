<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'frontend_color',
        'logo',
        'admin_logo',
        'admin_login_background',
        'admin_login_sidebar',
        'favicon',
        'site_name',
        'address',
        'description',
        'phone',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'google_plus'
    ];

    public static function get($key)
    {
        $setting = self::first();
        return $setting ? $setting->$key : null;
    }
}
