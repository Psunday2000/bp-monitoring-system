<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Caregiver\CaregiverProfileController;
use App\Http\Controllers\Patient\PatientProfileController;

Route::get('/', function () {
    return view('home');
})->middleware('redirectIfAuthenticated');

// Patient Dashboard Routes
Route::middleware('role:Patient')->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PatientProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [PatientProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [PatientProfileController::class, 'destroy'])->name('profile.destroy');
});

// Caregiver Dashboard Routes
Route::middleware('role:Caregiver')->prefix('caregiver')->name('caregiver.')->group(function () {
    Route::get('/dashboard', [CaregiverProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CaregiverProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [CaregiverProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [CaregiverProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/patient/{patient}/vital', [CaregiverProfileController::class, 'patientVitals'])->name('vitals');
});


require __DIR__.'/auth.php';
