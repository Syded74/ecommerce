<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Home Appliances',
            'Books',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category], [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
