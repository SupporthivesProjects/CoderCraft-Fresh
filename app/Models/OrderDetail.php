<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'seller_id',
        'product_id',
        'variation',
        'price',
        'tax',
        'shipping_cost',
        'quantity',
        'translation_file',
        'from_lang',
        'to_lang',
        'service_no_of_pages',
        'service_no_of_words',
        'delivery_datetime',
        'message',
        'payment_status',
        'delivery_status',
        'shipping_type',
        'pickup_point_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function pickupPoint()
    {
        return $this->belongsTo(PickupPoint::class);
    }
}
