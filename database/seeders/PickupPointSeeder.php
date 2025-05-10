<?php

namespace Database\Seeders;

use App\Models\PickupPoint;
use Illuminate\Database\Seeder;

class PickupPointSeeder extends Seeder
{
    public function run()
    {
        $pickupPoints = [
            [
                'staff_id' => 1,
                'name' => 'Main Branch',
                'address' => '123 Main Street, City',
                'phone' => '+1234567890',
                'pick_up_status' => 1,
                'cash_on_pickup_status' => 1
            ]
        ];

        foreach ($pickupPoints as $point) {
            PickupPoint::create($point);
        }
    }
}
