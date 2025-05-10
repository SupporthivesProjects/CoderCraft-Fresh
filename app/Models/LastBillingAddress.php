<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LastBillingAddress extends Model
{
    public $timestamps = false;
    protected $table = 'last_billing_address';

    protected $fillable = [
        'user_id',
        'email',
        'name',
        'lname',
        'address',
        'addressL2',
        'city',
        'postal_code',
        'country',
        'stateProvince',
        'dob',
        'phone'
    ];

    protected $dates = ['dob'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->lname}";
    }

    public static function getLastBillingAddress($userId)
    {
        return self::where('user_id', $userId)
            ->latest()
            ->first();
    }
}
