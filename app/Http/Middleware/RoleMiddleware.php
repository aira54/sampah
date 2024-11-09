<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        Log::info('User ID: ' . $user->id . ' checking roles: ' . implode(', ', $roles));

        // Ambil role user untuk debugging
        $userRoles = $user->roles->pluck('name')->toArray();
        Log::info('User roles: ' . implode(', ', $userRoles));

        // Cek apakah user memiliki salah satu role
        if ($user->roles()->whereIn('name', $roles)->count() == 0) {
            Log::info('User does not have the required role.');
            return abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

