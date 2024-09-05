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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $user = Auth::user();

            // Determine the dashboard based on the user's role
            if ($user->role->name === 'Caregiver') {
                return redirect()->route('caregiver.dashboard');
            } elseif ($user->role->name === 'Patient') {
                return redirect()->route('patient.dashboard');
            }

            // Handle other roles or default redirects here
        }

        return $next($request);
    }
}
