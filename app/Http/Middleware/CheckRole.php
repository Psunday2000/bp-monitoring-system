<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $desiredRole)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // If user role matches the desired role, proceed
            if ($userRole->name === $desiredRole) {
                return $next($request);
            }

            // Otherwise, log out and redirect to the home page
            Auth::logout();
            return redirect()->route('home');
        }

        // If not authenticated, redirect to login page
        return redirect()->route('login');
    }

}