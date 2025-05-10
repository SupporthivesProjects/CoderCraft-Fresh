<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    protected $fillable = ['sub_category_id', 'name', 'slug', 'meta_title', 'meta_description'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
