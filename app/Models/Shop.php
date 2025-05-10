<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id', 'name', 'logo', 'sliders', 'address',
        'facebook', 'google', 'twitter', 'youtube',
        'slug', 'meta_title', 'meta_description', 'pick_up_point_id'
    ];

    protected $casts = [
        'sliders' => 'array',
        'pick_up_point_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
