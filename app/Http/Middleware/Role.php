<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login, dan 'guest' termasuk role yang diizinkan
        if (!Auth::check()) {
            if (in_array('guest', $roles)) {
                return $next($request);
            }

            return response()->view('error.403');
        }

        $user = Auth::user();
        $roleUser = $user->role_id;

        // Jika role user cocok dengan salah satu role yang diizinkan
        if (in_array($roleUser, $roles)) {
            return $next($request);
        }

        // Selain itu: tolak akses
        return response()->view('error.403');
    }

}
