<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'lname' => 'Admin',
            'email' => 'admin@example.com',
            'user_type' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Customer User',
            'lname' => 'Customer',
            'email' => 'customer@example.com',
            'user_type' => 'customer',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);
    }
}
