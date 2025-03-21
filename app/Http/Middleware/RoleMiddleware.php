<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::check());
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['access' => 'Please login first!']);
        }

        $user = Auth::user();

        if ($user->role === 'patient' && $request->path() !== '/') {
            return redirect('/');
        }
    if (in_array($user->role, ['admin', 'doctor']) && !$request->is('dashboard*')) {
        return redirect('/dashboard');
    }

        return $next($request);
    }
}
