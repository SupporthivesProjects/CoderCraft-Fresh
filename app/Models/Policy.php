<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable = [
        'name',
        'content'
    ];

    public static function getPolicy($name)
    {
        return static::where('name', $name)->first();
    }
}
