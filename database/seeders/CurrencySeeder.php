<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run()
    {
        $currencies = [
            [
                'name' => 'U.S. Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.00000,
                'status' => 1,
                'code' => 'USD'
            ],
            [
                'name' => 'Australian Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.56000,
                'status' => 0,
                'code' => 'AUD'
            ],
            [
                'name' => 'Brazilian Real',
                'symbol' => 'R$',
                'exchange_rate' => 3.25000,
                'status' => 0,
                'code' => 'BRL'
            ],
            [
                'name' => 'Canadian Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.35000,
                'status' => 0,
                'code' => 'CAD'
            ],
            [
                'name' => 'Czech Koruna',
                'symbol' => 'Kč',
                'exchange_rate' => 20.65000,
                'status' => 0,
                'code' => 'CZK'
            ],
            [
                'name' => 'Danish Krone',
                'symbol' => 'kr',
                'exchange_rate' => 6.05000,
                'status' => 0,
                'code' => 'DKK'
            ],
            [
                'name' => 'Euro',
                'symbol' => '€',
                'exchange_rate' => 0.92000,
                'status' => 0,
                'code' => 'EUR'
            ],
            [
                'name' => 'Hong Kong Dollar',
                'symbol' => '$',
                'exchange_rate' => 7.83000,
                'status' => 0,
                'code' => 'HKD'
            ],
            [
                'name' => 'Hungarian Forint',
                'symbol' => 'Ft',
                'exchange_rate' => 255.24000,
                'status' => 0,
                'code' => 'HUF'
            ],
            [
                'name' => 'Israeli New Sheqel',
                'symbol' => '₪',
                'exchange_rate' => 3.48000,
                'status' => 0,
                'code' => 'ILS'
            ],
            [
                'name' => 'Japanese Yen',
                'symbol' => '¥',
                'exchange_rate' => 107.12000,
                'status' => 0,
                'code' => 'JPY'
            ],
            [
                'name' => 'Malaysian Ringgit',
                'symbol' => 'RM',
                'exchange_rate' => 3.91000,
                'status' => 0,
                'code' => 'MYR'
            ],
            [
                'name' => 'Mexican Peso',
                'symbol' => '$',
                'exchange_rate' => 18.72000,
                'status' => 0,
                'code' => 'MXN'
            ],
            [
                'name' => 'Norwegian Krone',
                'symbol' => 'kr',
                'exchange_rate' => 7.83000,
                'status' => 0,
                'code' => 'NOK'
            ],
            [
                'name' => 'New Zealand Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.38000,
                'status' => 0,
                'code' => 'NZD'
            ],
            [
                'name' => 'Philippine Peso',
                'symbol' => '₱',
                'exchange_rate' => 52.26000,
                'status' => 0,
                'code' => 'PHP'
            ],
            [
                'name' => 'Polish Zloty',
                'symbol' => 'zł',
                'exchange_rate' => 3.39000,
                'status' => 0,
                'code' => 'PLN'
            ],
            [
                'name' => 'Pound Sterling',
                'symbol' => '£',
                'exchange_rate' => 0.78000,
                'status' => 0,
                'code' => 'GBP'
            ],
            [
                'name' => 'Russian Ruble',
                'symbol' => 'руб',
                'exchange_rate' => 55.93000,
                'status' => 0,
                'code' => 'RUB'
            ],
            [
                'name' => 'Singapore Dollar',
                'symbol' => '$',
                'exchange_rate' => 1.32000,
                'status' => 0,
                'code' => 'SGD'
            ],
            [
                'name' => 'Swedish Krona',
                'symbol' => 'kr',
                'exchange_rate' => 8.19000,
                'status' => 0,
                'code' => 'SEK'
            ],
            [
                'name' => 'Swiss Franc',
                'symbol' => 'CHF',
                'exchange_rate' => 0.94000,
                'status' => 0,
                'code' => 'CHF'
            ],
            [
                'name' => 'Thai Baht',
                'symbol' => '฿',
                'exchange_rate' => 31.39000,
                'status' => 0,
                'code' => 'THB'
            ],
            [
                'name' => 'Taka',
                'symbol' => '৳',
                'exchange_rate' => 84.00000,
                'status' => 0,
                'code' => 'BDT'
            ],
            [
                'name' => 'Indian Rupee',
                'symbol' => 'Rs',
                'exchange_rate' => 68.45000,
                'status' => 0,
                'code' => 'Rupee'
            ],
            [
                'name' => 'Kenyan shilling',
                'symbol' => 'K',
                'exchange_rate' => 142.50000,
                'status' => 0,
                'code' => 'KES'
            ],
            [
                'name' => 'Naira',
                'symbol' => '₦',
                'exchange_rate' => 1532.43000,
                'status' => 1,
                'code' => 'NGN'
            ],
            [
                'name' => 'South Korean won',
                'symbol' => '₩',
                'exchange_rate' => 1336.89000,
                'status' => 0,
                'code' => 'KRW'
            ],
            [
                'name' => 'United Arab Emirates dirham',
                'symbol' => 'د.إ',
                'exchange_rate' => 3.67000,
                'status' => 0,
                'code' => 'AED'
            ],
            [
                'name' => 'Ghanaian cedi',
                'symbol' => 'GH₵‎',
                'exchange_rate' => 14.29000,
                'status' => 0,
                'code' => 'GHS'
            ]
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
