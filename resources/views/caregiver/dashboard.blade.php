<x-app-layout layout="caregiver">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Caregiver Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($patients as $carePoint)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h3 class="text-lg font-semibold">{{ $carePoint->patient->user->name }}</h3><br>
                            <p class="text-md text-gray-600">{{ $carePoint->patient->medical_history }}</p><br>
                            <a href="{{ route('caregiver.vitals', $carePoint->patient->id) }}" 
                                class="inline-block px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                View Vitals
                             </a>                             
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
    