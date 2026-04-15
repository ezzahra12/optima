<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next, string ...$guards): Response
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if ($user->role === 'admin') return redirect()->route('admin.index');
            if ($user->role === 'chef') return redirect()->route('chef.dashboard');
            if ($user->role === 'user') return redirect()->route('pending');
            return redirect()->route('pending');
        }
    }

    return $next($request);
}
}
