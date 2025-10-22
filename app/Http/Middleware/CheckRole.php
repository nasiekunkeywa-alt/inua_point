<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = $request->user();
        if (! $user || ! $user->role) {
            abort(403);
        }

        // Allow admin as superuser
        if ($user->role->name === 'admin') {
            return $next($request);
        }

        // Accept comma-separated roles: "role:admin,loan_officer"
        $allowed = array_map('trim', explode(',', $role));
        if (! in_array($user->role->name, $allowed, true)) {
            abort(403);
        }
        return $next($request);
    }
}
