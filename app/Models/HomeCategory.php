<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCategory extends Model
{
    protected $fillable = [
        'category_id',
        'subsubcategories',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSubsubcategoriesArray()
    {
        return json_decode($this->subsubcategories);
    }
}
