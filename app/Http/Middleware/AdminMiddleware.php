<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            Log::warning('Unauthenticated user attempted to access admin area');
            return redirect('login');
        }

        if (!Auth::user()->isAdmin()) {
            Log::warning('Non-admin user attempted to access admin area', ['user_id' => Auth::id(), 'role' => Auth::user()->role]);
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}