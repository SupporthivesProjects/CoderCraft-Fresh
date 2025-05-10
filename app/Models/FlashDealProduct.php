<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashDealProduct extends Model
{
    protected $fillable = [
        'flash_deal_id',
        'product_id',
        'discount',
        'discount_type'
    ];

    public function flashDeal()
    {
        return $this->belongsTo(FlashDeal::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateDiscountedPrice($originalPrice)
    {
        if ($this->discount_type == 'percent') {
            return $originalPrice - (($originalPrice * $this->discount) / 100);
        }
        return $originalPrice - $this->discount;
    }
}
