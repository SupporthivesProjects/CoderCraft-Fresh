<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    public function run()
    {
        $policies = [
            [
                'name' => 'privacy_policy',
                'content' => 'Privacy Policy content goes here'
            ],
            [
                'name' => 'terms_conditions',
                'content' => 'Terms and Conditions content goes here'
            ],
            [
                'name' => 'return_policy',
                'content' => 'Return Policy content goes here'
            ]
        ];

        foreach ($policies as $policy) {
            Policy::create($policy);
        }
    }
}
