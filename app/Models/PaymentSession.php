<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSession extends Model
{
    protected $fillable = [
        'token',
        'session_data',
        'order_id',
        'status'
    ];

    protected $casts = [
        'session_data' => 'array'
    ];
}
