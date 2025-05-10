<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandsTableSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            [
                'name' => 'Nike',
                'logo' => 'nike.png',
                'top' => 1,
                'slug' => 'nike',
                'meta_title' => 'Nike Sports Brand',
                'meta_description' => 'Leading sports and fitness brand worldwide'
            ],
            [
                'name' => 'Adidas',
                'logo' => 'adidas.png',
                'top' => 1,
                'slug' => 'adidas',
                'meta_title' => 'Adidas Sports Brand',
                'meta_description' => 'Premium sports and lifestyle products'
            ],
            [
                'name' => 'Puma',
                'logo' => 'puma.png',
                'top' => 0,
                'slug' => 'puma',
                'meta_title' => 'Puma Sports Brand',
                'meta_description' => 'Sports and casual wear for everyone'
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert(array_merge($brand, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
