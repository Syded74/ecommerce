<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        // Create sample brands
        Brand::create(['name' => 'Default Brand']);
        Brand::create(['name' => 'Another Brand']);
    }
}
