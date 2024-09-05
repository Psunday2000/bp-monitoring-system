<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('patient.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Medical History -->
        <div>
            <x-input-label for="medical_history" :value="__('Medical History')" />
            <textarea id="medical_history" name="medical_history" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('medical_history', $user->patient->medical_history) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('medical_history')" />
        </div>

        <!-- Current Medications -->
        <div>
            <x-input-label for="current_medications" :value="__('Current Medications')" />
            <textarea id="current_medications" name="current_medications" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('current_medications', $user->patient->current_medications) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('current_medications')" />
        </div>

        <!-- Emergency Contact -->
        <div>
            <x-input-label for="emergency_contact">
                {{ __('Emergency Contact') }}<br>
                <em>{{ __('e.g. +234 802 123 4567 (John Doe)') }}</em>
            </x-input-label>            
            <x-text-input id="emergency_contact" name="emergency_contact" type="text" class="mt-1 block w-full" :value="old('emergency_contact', $user->patient->emergency_contact)" />
            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
