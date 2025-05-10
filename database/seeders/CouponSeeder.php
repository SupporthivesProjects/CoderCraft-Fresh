<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run()
    {
        $coupons = [
            [
                'type' => 'welcome',
                'code' => 'WELCOME10',
                'details' => 'Welcome discount for new users',
                'discount' => 10.00,
                'discount_type' => 'percent',
                'start_date' => strtotime('2024-01-01'),
                'end_date' => strtotime('2024-12-31')
            ],
            [
                'type' => 'seasonal',
                'code' => 'SUMMER25',
                'details' => 'Summer season special discount',
                'discount' => 25.00,
                'discount_type' => 'percent',
                'start_date' => strtotime('2024-06-01'),
                'end_date' => strtotime('2024-08-31')
            ]
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
