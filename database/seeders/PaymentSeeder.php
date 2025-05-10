<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $payments = [
            [
                'seller_id' => 1,
                'amount' => 1000.00,
                'payment_method' => 'bank_transfer',
                'txn_code' => 'TXN'.strtoupper(uniqid()),
                'payment_details' => json_encode([
                    'bank' => 'Example Bank',
                    'account' => '****1234'
                ])
            ]
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
