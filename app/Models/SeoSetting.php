<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = ['keyword', 'author', 'revisit', 'sitemap_link', 'description'];
}
