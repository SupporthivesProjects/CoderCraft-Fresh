<?php

namespace Database\Seeders;

use App\Models\CustomerProduct;
use Illuminate\Database\Seeder;

class CustomerProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Sample Customer Product',
                'published' => 1,
                'status' => 1,
                'added_by' => 'customer',
                'user_id' => 1,
                'category_id' => 1,
                'unit_price' => 99.99,
                'description' => 'This is a sample customer product',
                'slug' => 'sample-customer-product'
            ]
        ];

        foreach ($products as $product) {
            CustomerProduct::create($product);
        }
    }
}
