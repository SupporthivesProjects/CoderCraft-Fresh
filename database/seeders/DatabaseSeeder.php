<?php

namespace Database\Seeders;

use App\Models\LastBillingAddress;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CurrencySeeder::class,
            CategorySeeder::class,
            BrandsTableSeeder::class,
            PolicySeeder::class,
            AttributesTableSeeder::class,
            BannersTableSeeder::class,
            BusinessSettingsSeeder::class,
            ColorSeeder::class,
            ConversationSeeder::class,
            CouponSeeder::class,
            FlashDealSeeder::class,
            GeneralSettingSeeder::class,
            HomeCategorySeeder::class,
            LanguageSeeder::class,
            LastBillingAddressSeeder::class,
            OrderSeeder::class,
            CountrySeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
