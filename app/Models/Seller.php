<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'user_id',
        'verification_status',
        'verification_info',
        'cash_on_delivery_status',
        'admin_to_pay',
        'bank_name',
        'bank_acc_name',
        'bank_acc_no',
        'bank_routing_no',
        'bank_payment_status'
    ];

    protected $casts = [
        'verification_info' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
