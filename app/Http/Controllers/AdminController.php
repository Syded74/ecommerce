<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::all(); // Ensure the correct namespace is used
        return view('admin.dashboard', compact('products'));
    }

    public function createUser()
    {
        return view('admin.create-user');
    }

    public function storeUser(Request $request)
    {
        Log::info('storeUser method called'); // Add this line for logging

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Log::info('Validation passed'); // Add this line for logging

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::info('User created: ' . $user->id); // Add this line for logging

        $user->assignRole('user'); // Automatically assign the 'user' role

        return redirect()->route('admin.dashboard')->with('success', 'User created successfully.');
    }
}
