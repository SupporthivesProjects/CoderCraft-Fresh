<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPackage extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'product_upload',
        'logo'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
