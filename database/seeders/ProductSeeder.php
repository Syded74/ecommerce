<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure there is at least one brand
        $brand = Brand::first();

        // Create sample products
        Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product.',
            'price' => 100,
            'image' => 'path/to/image.jpg',
            'brand_id' => $brand->id,
        ]);
    }
}
