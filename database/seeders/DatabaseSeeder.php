<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they do not exist
        if (!Role::where('name', 'super-admin')->exists()) {
            Role::create(['name' => 'super-admin']);
        }

        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }

        // Call other seeders
        $this->call([
            UsersTableSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class, // Added CategorySeeder here
            ProductSeeder::class,
        ]);
    }
}
