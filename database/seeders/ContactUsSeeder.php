<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    public function run()
    {
        $contacts = [
            [
                'fullname' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '+1234567890',
                'address' => '123 Main St',
                'message' => 'Interested in translation services',
                'native_lang' => 'English',
                'pairs_lang' => 'Spanish,French',
                'rate_per' => 'word',
                'lang_pairs_rate' => 'EN-ES:0.10,EN-FR:0.12',
                'medium' => 'website',
                'selected_service' => 'Translation',
                'from_page' => 'services'
            ]
        ];

        foreach ($contacts as $contact) {
            ContactUs::create($contact);
        }
    }
}
