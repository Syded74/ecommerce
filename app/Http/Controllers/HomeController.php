<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showWelcomePage');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('super-admin')) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function showWelcomePage()
    {
        $products = Product::all(); // Ensure this queries the correct model and table
        return view('welcome', compact('products'));
    }
}
