<?php

namespace Database\Seeders;

use App\Models\LastBillingAddress;
use Illuminate\Database\Seeder;

class LastBillingAddressSeeder extends Seeder
{
    public function run()
    {
        $addresses = [
            [
                'user_id' => 1,
                'email' => 'john@example.com',
                'name' => 'John',
                'lname' => 'Doe',
                'address' => '123 Main St',
                'addressL2' => 'Apt 4B',
                'city' => 'New York',
                'postal_code' => '10001',
                'country' => 'United States',
                'stateProvince' => 'NY',
                'dob' => '1990-01-01',
                'phone' => '+1234567890'
            ]
        ];

        foreach ($addresses as $address) {
            LastBillingAddress::create($address);
        }
    }
}
