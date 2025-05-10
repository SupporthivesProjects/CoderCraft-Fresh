<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'guest_id',
        'shipping_address',
        'payment_type',
        'payment_status',
        'payment_details',
        'grand_total',
        'coupon_discount',
        'code',
        'date',
        'viewed',
        'delivery_viewed',
        'payment_status_viewed',
        'commission_calculated'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getShippingAddressAttribute($value)
    {
        return json_decode($value);
    }

    public function getPaymentDetailsAttribute($value)
    {
        return json_decode($value);
    }

    public function scopeUserPurchaseHistory($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->orderBy('code', 'desc')
            ->paginate(15);
    }
}
