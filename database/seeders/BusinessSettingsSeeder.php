<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BusinessSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['id' => 1, 'type' => 'home_default_currency', 'value' => '1', 'created_at' => '2018-10-16 01:35:52', 'updated_at' => '2019-01-28 01:26:53'],
            ['id' => 2, 'type' => 'system_default_currency', 'value' => '1', 'created_at' => '2018-10-16 01:36:58', 'updated_at' => '2023-08-04 04:57:13'],
            ['id' => 3, 'type' => 'currency_format', 'value' => '1', 'created_at' => '2018-10-17 03:01:59', 'updated_at' => '2018-10-17 03:01:59'],
            ['id' => 4, 'type' => 'symbol_format', 'value' => '1', 'created_at' => '2018-10-17 03:01:59', 'updated_at' => '2019-01-20 02:10:55'],
            ['id' => 5, 'type' => 'no_of_decimals', 'value' => '2', 'created_at' => '2018-10-17 03:01:59', 'updated_at' => '2020-03-04 00:57:16'],
            ['id' => 6, 'type' => 'product_activation', 'value' => '1', 'created_at' => '2018-10-28 01:38:37', 'updated_at' => '2019-02-04 01:11:41'],
            ['id' => 7, 'type' => 'vendor_system_activation', 'value' => '0', 'created_at' => '2018-10-28 07:44:16', 'updated_at' => '2020-06-23 16:07:03'],
            ['id' => 8, 'type' => 'show_vendors', 'value' => '1', 'created_at' => '2018-10-28 07:44:47', 'updated_at' => '2019-02-04 01:11:13'],
            ['id' => 9, 'type' => 'paypal_payment', 'value' => '0', 'created_at' => '2018-10-28 07:45:16', 'updated_at' => '2019-01-31 05:09:10'],
            ['id' => 10, 'type' => 'stripe_payment', 'value' => '0', 'created_at' => '2018-10-28 07:45:47', 'updated_at' => '2018-11-14 01:51:51'],
            ['id' => 11, 'type' => 'cash_payment', 'value' => '1', 'created_at' => '2018-10-28 07:46:05', 'updated_at' => '2019-01-24 03:40:18'],
            ['id' => 12, 'type' => 'payumoney_payment', 'value' => '0', 'created_at' => '2018-10-28 07:46:27', 'updated_at' => '2019-03-05 05:41:36'],
            ['id' => 13, 'type' => 'best_selling', 'value' => '1', 'created_at' => '2018-12-24 08:13:44', 'updated_at' => '2019-02-14 05:29:13'],
            ['id' => 14, 'type' => 'paypal_sandbox', 'value' => '0', 'created_at' => '2019-01-16 12:44:18', 'updated_at' => '2019-01-16 12:44:18'],
            ['id' => 15, 'type' => 'sslcommerz_sandbox', 'value' => '1', 'created_at' => '2019-01-16 12:44:18', 'updated_at' => '2019-03-14 00:07:26'],
            ['id' => 16, 'type' => 'sslcommerz_payment', 'value' => '0', 'created_at' => '2019-01-24 09:39:07', 'updated_at' => '2019-01-29 06:13:46'],
            ['id' => 17, 'type' => 'vendor_commission', 'value' => '20', 'created_at' => '2019-01-31 06:18:04', 'updated_at' => '2019-04-13 06:49:26'],
            ['id' => 18, 'type' => 'verification_form', 'value' => '[{"type":"text","label":"Your name"},{"type":"text","label":"Shop name"},{"type":"text","label":"Email"},{"type":"text","label":"License No"},{"type":"text","label":"Full Address"},{"type":"text","label":"Phone Number"},{"type":"file","label":"Tax Papers"}]', 'created_at' => '2019-02-03 11:36:58', 'updated_at' => '2019-02-16 06:14:42'],
            ['id' => 19, 'type' => 'google_analytics', 'value' => '0', 'created_at' => '2019-02-06 12:22:35', 'updated_at' => '2019-02-06 12:22:35'],
            ['id' => 20, 'type' => 'facebook_login', 'value' => '0', 'created_at' => '2019-02-07 12:51:59', 'updated_at' => '2019-02-08 19:41:15'],
            ['id' => 21, 'type' => 'google_login', 'value' => '0', 'created_at' => '2019-02-07 12:52:10', 'updated_at' => '2019-02-08 19:41:14'],
            ['id' => 22, 'type' => 'twitter_login', 'value' => '0', 'created_at' => '2019-02-07 12:52:20', 'updated_at' => '2019-02-08 02:32:56'],
            ['id' => 23, 'type' => 'payumoney_payment', 'value' => '1', 'created_at' => '2019-03-05 11:38:17', 'updated_at' => '2019-03-05 11:38:17'],
            ['id' => 24, 'type' => 'payumoney_sandbox', 'value' => '1', 'created_at' => '2019-03-05 11:38:17', 'updated_at' => '2019-03-05 05:39:18'],
            ['id' => 36, 'type' => 'facebook_chat', 'value' => '0', 'created_at' => '2019-04-15 11:45:04', 'updated_at' => '2019-04-15 11:45:04'],
            ['id' => 37, 'type' => 'email_verification', 'value' => '1', 'created_at' => '2019-04-30 07:30:07', 'updated_at' => '2019-04-30 07:30:07'],
            ['id' => 38, 'type' => 'wallet_system', 'value' => '0', 'created_at' => '2019-05-19 08:05:44', 'updated_at' => '2019-05-19 02:11:57'],
            ['id' => 39, 'type' => 'coupon_system', 'value' => '1', 'created_at' => '2019-06-11 09:46:18', 'updated_at' => '2020-06-23 16:07:13'],
            ['id' => 40, 'type' => 'current_version', 'value' => '1.0', 'created_at' => '2019-06-11 09:46:18', 'updated_at' => '2019-06-11 09:46:18'],
            ['id' => 41, 'type' => 'instamojo_payment', 'value' => '0', 'created_at' => '2019-07-06 09:58:03', 'updated_at' => '2019-07-06 09:58:03'],
            ['id' => 42, 'type' => 'instamojo_sandbox', 'value' => '1', 'created_at' => '2019-07-06 09:58:43', 'updated_at' => '2019-07-06 09:58:43'],
            ['id' => 43, 'type' => 'razorpay', 'value' => '0', 'created_at' => '2019-07-06 09:58:43', 'updated_at' => '2019-07-06 09:58:43'],
            ['id' => 44, 'type' => 'paystack', 'value' => '0', 'created_at' => '2019-07-21 13:00:38', 'updated_at' => '2019-07-21 13:00:38'],
            ['id' => 45, 'type' => 'pickup_point', 'value' => '0', 'created_at' => '2019-10-17 11:50:39', 'updated_at' => '2019-10-17 11:50:39'],
            ['id' => 46, 'type' => 'maintenance_mode', 'value' => '0', 'created_at' => '2019-10-17 11:51:04', 'updated_at' => '2019-10-17 11:51:04'],
            ['id' => 47, 'type' => 'voguepay', 'value' => '0', 'created_at' => '2019-10-17 11:51:24', 'updated_at' => '2019-10-17 11:51:24'],
            ['id' => 48, 'type' => 'voguepay_sandbox', 'value' => '0', 'created_at' => '2019-10-17 11:51:38', 'updated_at' => '2019-10-17 11:51:38'],
            ['id' => 50, 'type' => 'category_wise_commission', 'value' => '0', 'created_at' => '2020-01-21 07:22:47', 'updated_at' => '2020-01-21 07:22:47'],
            ['id' => 51, 'type' => 'conversation_system', 'value' => '0', 'created_at' => '2020-01-21 07:23:21', 'updated_at' => '2020-06-23 16:07:07'],
            ['id' => 52, 'type' => 'guest_checkout_active', 'value' => '0', 'created_at' => '2020-01-22 07:36:38', 'updated_at' => '2020-06-23 16:07:08'],
            ['id' => 53, 'type' => 'facebook_pixel', 'value' => '0', 'created_at' => '2020-01-22 11:43:58', 'updated_at' => '2020-01-22 11:43:58'],
            ['id' => 55, 'type' => 'classified_product', 'value' => '0', 'created_at' => '2020-05-13 13:01:05', 'updated_at' => '2020-05-13 13:01:05'],
            ['id' => 56, 'type' => 'citigate_sandbox', 'value' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 57, 'type' => 'citigate_payment', 'value' => '1', 'created_at' => '2020-07-04 07:45:16', 'updated_at' => null],
        ];

        foreach ($settings as $setting) {
            BusinessSetting::create($setting);
        }
    }
}
