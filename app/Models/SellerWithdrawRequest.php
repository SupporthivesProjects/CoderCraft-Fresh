<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerWithdrawRequest extends Model
{
    protected $fillable = ['user_id', 'amount', 'message', 'status', 'viewed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
