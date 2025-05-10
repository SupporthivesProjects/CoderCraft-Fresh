<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'type',
        'code',
        'details',
        'discount',
        'discount_type',
        'start_date',
        'end_date'
    ];

    public function isValid()
    {
        $now = time();
        return $this->start_date <= $now && $now <= $this->end_date;
    }

    public function calculateDiscount($amount)
    {
        if ($this->discount_type == 'percent') {
            return ($amount * $this->discount) / 100;
        }
        return $this->discount;
    }
}
