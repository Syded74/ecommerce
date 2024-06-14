<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product.',
            'price' => 100,
            'image' => 'path/to/image.jpg',
            'brand_id' => 1, // assuming brand with ID 1 exists
            'category_id' => 1, // assuming category with ID 1 exists
        ]);
    }
}
