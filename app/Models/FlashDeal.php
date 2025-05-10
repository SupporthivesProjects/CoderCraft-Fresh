<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'status',
        'featured',
        'background_color',
        'text_color',
        'banner',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany(FlashDealProduct::class);
    }

    public function isActive()
    {
        return $this->status && time() >= $this->start_date && time() <= $this->end_date;
    }
}
