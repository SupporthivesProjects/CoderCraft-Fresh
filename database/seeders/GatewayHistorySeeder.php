<?php

namespace Database\Seeders;

use App\Models\GatewayHistory;
use Illuminate\Database\Seeder;

class GatewayHistorySeeder extends Seeder
{
    public function run()
    {
        $transactions = [
            [
                'TransactionID' => 1234567890,
                'MerchantRef' => 'MER123456',
                'TransTypeID' => 1,
                'Currency' => 'USD',
                'Amount' => 1000,
                'BusinessCase' => 'PURCHASE',
                'Descriptor' => 'Online Purchase',
                'Bank' => 'Test Bank',
                'ResponseCode' => 0,
                'ResponseDescription' => 'Success',
                'BankCode' => 'TB001',
                'BankDescription' => 'Test Bank Transaction',
                'Signature' => hash('sha256', 'test_signature')
            ]
        ];

        foreach ($transactions as $transaction) {
            GatewayHistory::create($transaction);
        }
    }
}
