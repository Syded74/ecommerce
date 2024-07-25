<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'super-admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Create Super Admin
        if (!User::where('email', 'superadmin@gmail.com')->exists()) {
            $superAdmin = User::create([
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'),
            ]);
            $superAdmin->assignRole('super-admin');
        }

        // Create Admin
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]);
            $admin->assignRole('admin');
        }

        // Create User
        if (!User::where('email', 'user@gmail.com')->exists()) {
            $user = User::create([
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('user');
        }
    }
}
