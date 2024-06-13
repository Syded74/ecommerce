<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'user']);

        // Call other seeders
        $this->call([
            UsersTableSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class, 
        ]);
    }
}
