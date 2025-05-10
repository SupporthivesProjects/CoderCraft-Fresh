<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'code', 'user_id', 'subject', 'details',
        'files', 'status', 'viewed', 'client_viewed'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }
}
