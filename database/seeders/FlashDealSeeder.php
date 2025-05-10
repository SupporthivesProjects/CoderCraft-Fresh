<?php

namespace Database\Seeders;

use App\Models\FlashDeal;
use Illuminate\Database\Seeder;

class FlashDealSeeder extends Seeder
{
    public function run()
    {
        $deals = [
            [
                'title' => 'Summer Sale',
                'start_date' => strtotime('2024-06-01'),
                'end_date' => strtotime('2024-06-30'),
                'status' => 1,
                'featured' => 1,
                'background_color' => '#FF5733',
                'text_color' => '#FFFFFF',
                'slug' => 'summer-sale'
            ],
            [
                'title' => 'Black Friday',
                'start_date' => strtotime('2024-11-25'),
                'end_date' => strtotime('2024-11-27'),
                'status' => 1,
                'featured' => 1,
                'background_color' => '#000000',
                'text_color' => '#FFFFFF',
                'slug' => 'black-friday'
            ]
        ];

        foreach ($deals as $deal) {
            FlashDeal::create($deal);
        }
    }
}
