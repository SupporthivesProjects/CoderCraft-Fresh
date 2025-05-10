<?php

namespace Database\Seeders;

use App\Models\CustomerPackage;
use Illuminate\Database\Seeder;

class CustomerPackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'Basic Package',
                'amount' => 0.00,
                'product_upload' => 5,
                'logo' => 'basic.png'
            ],
            [
                'name' => 'Premium Package',
                'amount' => 99.99,
                'product_upload' => 50,
                'logo' => 'premium.png'
            ],
            [
                'name' => 'Business Package',
                'amount' => 199.99,
                'product_upload' => 100,
                'logo' => 'business.png'
            ]
        ];

        foreach ($packages as $package) {
            CustomerPackage::create($package);
        }
    }
}
