<?php

namespace App\Http\Controllers\Patient;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Device;
use App\Models\Patient;
use App\Models\VitalSign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PatientProfileController extends Controller
{
    /**
     * Display the patient dashboard.
     */
    public function dashboard()
    {
        // Fetch current patient
        $id = Auth::user()->id;
        $patient = Patient::where('user_id', $id)->first();

        // Check if patient exists
        if (!$patient) {
            // Handle the case where the patient is not found
            return redirect()->route('home')->withErrors('Patient not found.');
        }

        $patient_id = $patient->id;

        // Fetch patient's vital signs and devices
        $vitals = VitalSign::where('patient_id', $patient_id)->get();
        $device = Device::where('patient_id', $patient_id)->get();

        return view('patient.dashboard', compact('patient', 'vitals', 'device'));
    }


    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('patient.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the patient's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'medical_history' => 'nullable|string',
            'current_medications' => 'nullable|string',
            'emergency_contact' => 'nullable|string',
        ]);

        $user = $request->user();
        
        // Update user's basic information
        $user->fill($request->only('name', 'email'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update patient's additional details
        if ($user->patient) {
            $user->patient->update([
                'medical_history' => $request->input('medical_history'),
                'current_medications' => $request->input('current_medications'),
                'emergency_contact' => $request->input('emergency_contact'),
            ]);
        }

        return Redirect::route('patient.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
