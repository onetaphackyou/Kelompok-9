<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Assuming the user's role is stored in a 'role' attribute or column
        $userRole = Auth::user()->role;

        if ($userRole !== $role) {
            abort(403, 'Access denied – insufficient role.');
        }

        return $next($request);
    }
}
