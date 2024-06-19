<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            if ($userRole == 2) {
                return redirect('/admin/users')->with('error', 'You are already logged in.');
            }

            if ($userRole == 1) {
                return redirect('/')->with('error', 'You are already logged in.');
            }
        }

        return $next($request);
    }
}
