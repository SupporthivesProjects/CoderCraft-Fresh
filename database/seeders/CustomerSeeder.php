<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['user_id' => 1],
            ['user_id' => 2],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
