<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;
            if ($userRole >= (int) $role) {
                return $next($request);
            }
        }

        return redirect('/login')->with('error', 'Please log in to access this page.');
    }
}
