<x-app-layout layout="patient">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Medical History and Current Medications -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Medical History</h3>
                    <p>{{ $patient->medical_history ?? 'No medical history provided.' }}</p>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Current Medications</h3>
                    <p>{{ $patient->current_medications ?? 'No current medications provided.' }}</p>
                </div>

                <!-- Vital Signs -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Vital Signs</h3>
                    @if($vitals->isEmpty())
                        <p>No vital signs data available.</p>
                    @else
                        <ul>
                            @foreach($vitals as $vital)
                                <li class="py-2 border-b">
                                    <strong>Blood Pressure:</strong> {{ $vital->blood_pressure }} mmHg<br>
                                    <strong>Pulse Rate:</strong> {{ $vital->pulse_rate }} bpm<br>
                                    <strong>Timestamp:</strong> {{ $vital->timestamp }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Device Information -->
                <div>
                    <h3 class="text-lg font-semibold">Device Information</h3>
                    @if($patient->device)
                        <p><strong>Device Type:</strong> {{ $patient->device->device_type ?? "" }}</p>
                        <p><strong>Device Model:</strong> {{ $patient->device->device_model ?? "" }}</p>
                        <p><strong>Manufacturer:</strong> {{ $patient->device->manufacturer ?? "" }}</p>
                        <p><strong>Installation Date:</strong> {{ $patient->device->installation_date ?? "" }}</p>
                        <p><strong>Status:</strong> {{ $patient->device->status ?? "" }}</p>
                    @else
                        <p>No device information available.</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>