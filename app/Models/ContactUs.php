<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contactus';

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'address',
        'message',
        'native_lang',
        'pairs_lang',
        'rate_per',
        'lang_pairs_rate',
        'medium',
        'selected_service',
        'attachment',
        'from_page',
        'ip_address',
        'submitted_at'
    ];

    public function scopeIpSubmissionsToday($query, $ip)
    {
        return $query->where('ip_address', $ip)
            ->whereDate('submitted_at', Carbon::today())
            ->count();
    }
}
