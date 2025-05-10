<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['name', 'category_id', 'slug', 'meta_title', 'meta_description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class);
    }
}
