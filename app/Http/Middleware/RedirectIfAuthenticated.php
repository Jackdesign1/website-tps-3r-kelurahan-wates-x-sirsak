<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     * FIX: Redirect ke admin.dashboard jika sudah login,
     * bukan ke '/' (beranda publik)
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Redirect ke admin dashboard, bukan ke '/'
                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
