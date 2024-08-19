<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function show()
    {
        $admin = Auth::user();
        Log::info('AdminProfileController: show method called', ['user_id' => $admin->id, 'role' => $admin->getRoleNames()]);
        
        return view('admin.adminprofile.show', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.adminprofile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        ]);

        $admin->update($validated);
        
        return redirect()->route('admin.admin-profile.show')->with('success', 'Profile updated successfully.');
    }
}