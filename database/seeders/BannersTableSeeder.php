<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('banners')->insert([
            [
                'photo' => 'banner1.jpg',
                'url' => 'https://example.com/promo1',
                'position' => 1,
                'published' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'photo' => 'banner2.jpg',
                'url' => 'https://example.com/promo2',
                'position' => 2,
                'published' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'photo' => 'banner3.jpg',
                'url' => 'https://example.com/promo3',
                'position' => 3,
                'published' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
