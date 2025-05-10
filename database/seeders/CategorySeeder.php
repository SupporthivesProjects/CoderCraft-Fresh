<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'id' => 4,
                'name' => 'E-books',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/lxWvMx9xwMsjhrTlBsCwrFPT2M3cvScnkFPMkLYW.svg',
                'icon' => 'uploads/categories/icon/hAq2LvhYtoMBLg0g0SHnG3HIyTS9tOO3ft7Crkm1.svg',
                'featured' => 0,
                'top' => 0,
                'slug' => 'E-books-7waf2',
                'meta_title' => null,
                'meta_description' => null,
                'created_at' => '2020-06-23 15:43:43',
                'updated_at' => '2020-06-23 15:43:43'
            ],
            [
                'id' => 5,
                'name' => 'Video',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/7ypnFaWkbuiDPCjbIEfCKQVTZbBBYRgkD2KMlnZm.svg',
                'icon' => 'uploads/categories/icon/P5aKRSEBPQk7TH16Mj60GD6d44Zpw5VZfGgsKVf7.svg',
                'featured' => 0,
                'top' => 0,
                'slug' => 'Video-9FwUw',
                'meta_title' => null,
                'meta_description' => null,
                'created_at' => '2020-06-23 15:44:27',
                'updated_at' => '2020-06-23 15:44:27'
            ],
            [
                'id' => 6,
                'name' => 'Software',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/E92xzPJoXftHiZy2EWuJZYeDbz9F25zTVTdLBZuI.svg',
                'icon' => 'uploads/categories/icon/qfvdNQMSzd334cM2DlRAFmvh02qJJM1RBHQ77bjx.svg',
                'featured' => 0,
                'top' => 0,
                'slug' => 'Software-OYpjB',
                'meta_title' => null,
                'meta_description' => null,
                'created_at' => '2020-06-23 15:45:28',
                'updated_at' => '2020-06-23 15:45:28'
            ],
            [
                'id' => 7,
                'name' => 'Templates',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/oTaqpk9z5r1Stbn1pxMA4S8ri73bpaXTyK6Icb3n.svg',
                'icon' => 'uploads/categories/icon/PARYO1vTB11aDolQVRq09hrQHernqpLQ7MZjc4Fb.svg',
                'featured' => 0,
                'top' => 0,
                'slug' => 'Templates-YAGFn',
                'meta_title' => null,
                'meta_description' => null,
                'created_at' => '2020-06-23 15:46:55',
                'updated_at' => '2020-06-23 15:46:55'
            ],
            [
                'id' => 8,
                'name' => 'Audio Book',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/of8faZfookxsj26qiBqJMiuVmzWxvMKGqjdb96aR.png',
                'icon' => null,
                'featured' => 0,
                'top' => 0,
                'slug' => 'Audio-Book-slmnk',
                'meta_title' => null,
                'meta_description' => null,
                'created_at' => '2020-07-13 17:46:50',
                'updated_at' => '2020-07-13 17:46:50'
            ],
            [
                'id' => 9,
                'name' => 'Bundle',
                'commision_rate' => 0.00,
                'banner' => 'uploads/categories/banner/2qiuhhzdE5t6mskktZVKbUqbsm5t7Y4Jh2DVwfJ0.png',
                'icon' => 'uploads/categories/icon/aqnoXIEH7fJiNsavYRRA3nSKZyQwQbfVUsEhvtKK.png',
                'featured' => 0,
                'top' => 0,
                'slug' => 'Bundle-Eniw8',
                'meta_title' => 'Bundle',
                'meta_description' => 'Bundle',
                'created_at' => '2021-10-20 08:16:56',
                'updated_at' => '2021-10-20 08:16:56'
            ]
        ];

        foreach ($categories as $category) {
            // Convert string dates to Carbon instances if they're not null
            if (!empty($category['created_at'])) {
                $category['created_at'] = Carbon::parse($category['created_at']);
            }
            if (!empty($category['updated_at'])) {
                $category['updated_at'] = Carbon::parse($category['updated_at']);
            }
            
            // Check if category with this ID already exists
            $existingCategory = Category::find($category['id']);
            
            if ($existingCategory) {
                // Update existing category
                $existingCategory->update($category);
            } else {
                // Create new category
                Category::create($category);
            }
        }
    }
}
