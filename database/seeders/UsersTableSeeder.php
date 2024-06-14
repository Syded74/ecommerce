<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Check if the super-admin user already exists
        if (!User::where('email', 'superadmin@gmail.com')->exists()) {
            // Create the super-admin user
            $superAdmin = User::create([
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'), // Use a secure password
            ]);

            // Assign the super-admin role
            $superAdmin->assignRole('super-admin');
        }

        // Similarly, check and create other users if needed
        // Check if the admin user already exists
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'), // Use a secure password
            ]);

            // Assign the admin role
            $admin->assignRole('admin');
        }

        // Check if the user already exists
        if (!User::where('email', 'user@gmail.com')->exists()) {
            $user = User::create([
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'), // Use a secure password
            ]);

            // Assign the user role
            $user->assignRole('user');
        }
    }
}
