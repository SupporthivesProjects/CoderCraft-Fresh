<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'payment_details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function deductBalance($userId, $amount)
    {
        return DB::table('wallets')
            ->where('user_id', $userId)
            ->update(['balance' => DB::raw("balance - $amount")]);
    }
}
