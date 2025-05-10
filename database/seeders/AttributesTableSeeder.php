<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('attributes')->insert([
            [
                'name' => 'Size',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Color',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Material',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
