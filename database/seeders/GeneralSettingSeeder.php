<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run()
    {
        GeneralSetting::create([
            'frontend_color' => 'default',
            'site_name' => 'My Website',
            'description' => 'Welcome to our website',
            'address' => '123 Main Street, City, Country',
            'phone' => '+1234567890',
            'email' => 'info@example.com',
            'facebook' => 'https://facebook.com/mywebsite',
            'instagram' => 'https://instagram.com/mywebsite',
            'twitter' => 'https://twitter.com/mywebsite',
            'youtube' => 'https://youtube.com/mywebsite'
        ]);
    }
}
