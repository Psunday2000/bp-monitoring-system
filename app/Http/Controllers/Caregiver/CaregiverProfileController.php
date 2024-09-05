<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CareGiver;
use App\Models\CarePoint;
use App\Models\Patient;
use App\Models\VitalSign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CaregiverProfileController extends Controller
{
    
    /**
     * Display the caregiver dashboard.
     */
    public function dashboard(){
        // Fetch all patients assigned to the logged-in caregiver
        $patients = CarePoint::where('caregiver_id', Auth::id())->with('patient')->get();
        
        return view('caregiver.dashboard', compact('patients'));
    }

    public function patientVitals(Patient $patient)
    {
        // Fetch the patient's vital signs with the related device
        $vitals = VitalSign::with('device')->where('patient_id', $patient->id)->get();

        // Return the view with the patient's vital signs and device information
        return view('caregiver.patient-vitals', compact('patient', 'vitals'));
    }
    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('caregiver.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Fill the user model with validated data
        $user->fill($request->validated());

        // Check if email is being updated, if so, reset the email verification timestamp
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the user model
        $user->save();

        // Update caregiver specific details
        $specialize = $request->input('specialization');
        $license = $request->input('license_number');

        // Assuming the `user_id` is the foreign key in the `caregivers` table
        $caregiver = CareGiver::where('user_id', $user->id)->first();

        if ($caregiver) {
            $caregiver->specialization = $specialize;
            $caregiver->license_number = $license;
            $caregiver->save();
        }

        // Redirect with a success message
        return Redirect::route('caregiver.profile.edit')->with('status', 'profile-updated');
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
