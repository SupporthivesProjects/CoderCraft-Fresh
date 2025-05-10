<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    protected $fillable = [
        'name',
        'published',
        'status',
        'added_by',
        'user_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'brand_id',
        'photos',
        'thumbnail_img',
        'conditon',
        'location',
        'video_provider',
        'video_link',
        'unit',
        'tags',
        'description',
        'unit_price',
        'meta_title',
        'meta_description',
        'meta_img',
        'pdf',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function subsubcategory()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
