<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $fillable = ['type', 'value'];

    public static function get($key)
    {
        $setting = self::where('type', $key)->first();
        return $setting ? $setting->value : null;
    }

    public static function getSystemDefaultCurrency()
    {
        return self::where('type', 'system_default_currency')->first()->value;
    }
}
