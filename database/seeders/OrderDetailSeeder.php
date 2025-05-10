<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    public function run()
    {
        $orderDetails = [
            [
                'order_id' => 1,
                'product_id' => 1,
                'price' => 99.99,
                'quantity' => 2,
                'payment_status' => 'paid',
                'delivery_status' => 'delivered'
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'price' => 149.99,
                'quantity' => 1,
                'payment_status' => 'paid',
                'delivery_status' => 'delivered'
            ]
        ];

        foreach ($orderDetails as $detail) {
            OrderDetail::create($detail);
        }
    }
}
