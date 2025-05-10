<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'commision_rate', 'banner', 'icon', 'featured', 'top', 'slug', 'meta_title', 'meta_description'
    ];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all categories with published product counts
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function withPublishedProductCounts()
    {
        return self::withCount(['products' => function($query) {
            $query->where('published', 1);
        }])->get();
    }

    /**
     * Get count of published products for this category
     *
     * @return int
     */
    public function publishedProductCount()
    {
        return $this->products()->where('published', 1)->count();
    }
}
