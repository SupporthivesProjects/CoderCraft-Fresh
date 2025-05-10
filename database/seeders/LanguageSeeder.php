<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            [
                'name' => 'English',
                'code' => 'en',
                'rtl' => 0
            ],
            [
                'name' => 'Arabic',
                'code' => 'ar',
                'rtl' => 1
            ],
            [
                'name' => 'French',
                'code' => 'fr',
                'rtl' => 0
            ]
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
