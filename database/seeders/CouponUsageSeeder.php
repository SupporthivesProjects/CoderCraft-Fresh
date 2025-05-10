<?php

namespace Database\Seeders;

use App\Models\CouponUsage;
use Illuminate\Database\Seeder;

class CouponUsageSeeder extends Seeder
{
    public function run()
    {
        $usages = [
            [
                'user_id' => 1,
                'coupon_id' => 1
            ],
            [
                'user_id' => 2,
                'coupon_id' => 1
            ]
        ];

        foreach ($usages as $usage) {
            CouponUsage::create($usage);
        }
    }
}
