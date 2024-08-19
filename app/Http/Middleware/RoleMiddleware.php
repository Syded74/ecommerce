<?php
// app/Http/Middleware/RoleMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
            public function handle($request, Closure $next, $role)
            {
                if (!Auth::check()) {
                    return redirect('login');
                }
            
                $userRole = $request->user()->role;
            
                // Check if the user's role matches any of the required roles
                $roles = is_array($role) ? $role : explode('|', $role);
            
                if (!in_array($userRole, $roles)) {
                    \Log::info('User ' . $request->user()->id . ' with role ' . $userRole . ' attempted to access a route requiring ' . implode(' or ', $roles));
                    abort(403, 'Unauthorized action.');
                }
            
                return $next($request);
            }
}

