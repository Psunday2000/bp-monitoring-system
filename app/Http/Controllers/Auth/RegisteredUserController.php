<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Fetch roles from the database
        $roles = Role::all(); // Adjust this if you use a different model or relationship for roles

        return view('auth.register', ['roles' => $roles]);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:roles,id'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'license_number' => ['nullable', 'string', 'max:255'],
        ]);

        // Create the user with role_id
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // Save additional data based on role
        if ($request->role_id == 1) { // Caregiver
            $user->caregiver()->create([
                'specialization' => $request->specialization,
                'license_number' => $request->license_number,
                'user_id' => $user->id,
            ]);
        } elseif ($request->role_id == 2) { // Patient
            $user->patient()->create([
                'user_id' => $user->id,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect to specific dashboard based on role_id
        $role = $user->role->name;
        if ($role === 'Patient') {
            return redirect()->route('patient.dashboard');
        } elseif ($role === 'Caregiver') {
            return redirect()->route('caregiver.dashboard');
        } else {
            return redirect()->route('home'); // Fallback route
        }
    }

}
