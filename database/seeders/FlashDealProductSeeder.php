<?php

namespace Database\Seeders;

use App\Models\FlashDealProduct;
use Illuminate\Database\Seeder;

class FlashDealProductSeeder extends Seeder
{
    public function run()
    {
        $flashDealProducts = [
            [
                'flash_deal_id' => 1,
                'product_id' => 1,
                'discount' => 20.00,
                'discount_type' => 'percent'
            ],
            [
                'flash_deal_id' => 1,
                'product_id' => 2,
                'discount' => 50.00,
                'discount_type' => 'flat'
            ]
        ];

        foreach ($flashDealProducts as $product) {
            FlashDealProduct::create($product);
        }
    }
}
