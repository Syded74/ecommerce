<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Creating  Super Admin
        $superAdmin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('super-admin');

        // Creating  Admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Creating  User
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('user');
    }
}
