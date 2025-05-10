<?php

namespace Database\Seeders;

use App\Models\HomeCategory;
use Illuminate\Database\Seeder;

class HomeCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'category_id' => 4,
                'subsubcategories' => json_encode([1, 2, 3]),
                'status' => 1
            ],
            [
                'category_id' => 5,
                'subsubcategories' => json_encode([4, 5, 6]),
                'status' => 1
            ]
        ];

        foreach ($categories as $category) {
            HomeCategory::create($category);
        }
    }
}
