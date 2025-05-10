<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupPoint extends Model
{
    protected $fillable = [
        'staff_id',
        'name',
        'address',
        'phone',
        'pick_up_status',
        'cash_on_pickup_status'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
