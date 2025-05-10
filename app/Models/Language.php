<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'rtl'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getTranslatedName()
    {
        return __('languages.'.$this->code);
    }
}
