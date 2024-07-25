<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        if ($filter == 'deleted') {
            $users = User::onlyTrashed()->get();
        } else {
            $users = User::when($filter == 'active', function ($query) {
                return $query->where('status', 'active');
            })->when($filter == 'inactive', function ($query) {
                return $query->where('status', 'inactive');
            })->get();
        }

        return view('admin.users.index', compact('users', 'filter'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'User restored successfully.');
    }


   
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('admin.users.index')->with('success', 'User permanently deleted.');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active', // default status
        ]);

        $user->assignRole('user'); // Automatically assign the 'user' role

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User status updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }


    public function show($id)
{
    $user = User::findOrFail($id);

    return view('admin.users.show', compact('user'));
}

//user dashboard controllers
public function dashboard()
{
    $products = Product::all(); // Get all products from the database
    return view('user.dashboard', compact('products'));
}

}
