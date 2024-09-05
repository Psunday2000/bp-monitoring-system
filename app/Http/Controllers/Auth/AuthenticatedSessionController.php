<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Log::info('Store method started'); // Log the start of the method

        // Authenticate the user
        try {
            $request->authenticate();
            Log::info('User authentication successful');
        } catch (\Exception $e) {
            Log::error('Authentication failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors('Authentication failed.');
        }

        // Regenerate session to prevent session fixation
        try {
            $request->session()->regenerate();
            Log::info('Session regenerated successfully');
        } catch (\Exception $e) {
            Log::error('Session regeneration failed: ' . $e->getMessage());
        }

        // Get the authenticated user
        $user = Auth::user();
        Log::info('Authenticated user retrieved', ['user_id' => $user->id]);

        // Redirect to the specific dashboard based on the user's role
        if ($user && $user->role) {
            $role = $user->role->name; // Assuming 'name' is the column for the role
            Log::info('User role identified', ['role' => $role]);

            switch ($role) {
                case 'Patient':
                    Log::info('Redirecting to patient dashboard');
                    return redirect()->route('patient.dashboard');
                case 'Caregiver':
                    Log::info('Redirecting to caregiver dashboard');
                    return redirect()->route('caregiver.dashboard');
                default:
                    Log::warning('Invalid role detected', ['role' => $role]);
                    // Logout and redirect to home if the role doesn't match the expected roles
                    Auth::guard('web')->logout();
                    return redirect()->route('home');
            }
        } else {
            Log::error('User or role is null');
            Auth::guard('web')->logout();
            return redirect()->route('home');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
