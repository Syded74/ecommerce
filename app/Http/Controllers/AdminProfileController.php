<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function show()
    {
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            // Add other fields as necessary
        ]);

        $admin->update($request->only(['name', 'email']));
        
        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }
}