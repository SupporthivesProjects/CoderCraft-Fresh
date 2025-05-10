<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'user_id' => 1,
                'shipping_address' => json_encode([
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'country' => 'USA'
                ]),
                'payment_type' => 'card',
                'payment_status' => 'paid',
                'grand_total' => 299.99,
                'date' => strtotime('now'),
                'code' => 'ORD-' . strtoupper(uniqid())
            ]
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
