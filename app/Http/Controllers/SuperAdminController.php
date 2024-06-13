<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admins = User::role('admin')->get();
        return view('superadmin.dashboard', compact('admins'));
    }

    public function createAdmin()
    {
        return view('superadmin.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $admin->assignRole('admin');

        return redirect()->route('superadmin.dashboard')->with('success', 'Admin created successfully.');
    }
}
