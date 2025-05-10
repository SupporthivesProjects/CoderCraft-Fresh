<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static function getPublishedProducts()
    {
        return self::where('published', 1)->count();
    }

    public static function getPublishedSellerProducts()
    {
        return self::where('published', 1)
            ->where('added_by', 'seller')
            ->count();
    }

    public static function getPublishedAdminProducts()
    {
        return self::where('published', 1)
            ->where('added_by', 'admin')
            ->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
