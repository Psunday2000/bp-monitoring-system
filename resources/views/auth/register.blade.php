<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role Selection Tabs -->
        <div class="mb-4">
            <ul class="flex border-b">
                @foreach ($roles as $role)
                    <li class="mr-1">
                        <a href="#" 
                           class="inline-block py-2 px-4 text-gray-600 hover:text-blue-500 rounded-t hover:bg-gray-100 {{ $loop->first ? 'bg-blue-500 text-white' : '' }}" 
                           onclick="selectRole({{ $role->id }}, '{{ $role->name }}', event)">
                            {{ $role->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <input type="hidden" id="role_id" name="role_id" value="{{ $roles->first()->id }}">
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Additional Fields for Caregivers -->
        <div id="caregiver-fields" class="hidden mt-4">
            <div>
                <x-input-label for="specialization" :value="__('Specialization')" />
                <x-text-input id="specialization" class="block mt-1 w-full" type="text" name="specialization" :value="old('specialization')" />
                <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="license_number" :value="__('License Number')" />
                <x-text-input id="license_number" class="block mt-1 w-full" type="text" name="license_number" :value="old('license_number')" />
                <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between mt-4 space-x-4">
            <div class="flex space-x-4">
                <h4 class="text-sm">&copy; Copyright 2024 Oko Chikaodiri - HND 2</h4>
            </div>
        </div>   
    </form>

    <script>
        function selectRole(roleId, roleName, event) {
            event.preventDefault(); // Prevent default anchor behavior
            document.getElementById('role_id').value = roleId;
            var tabs = document.querySelectorAll('.flex a');
            tabs.forEach(function(tab) {
                tab.classList.remove('bg-blue-500', 'text-white');
                tab.classList.add('text-gray-600', 'hover:text-blue-500');
                tab.classList.add('hover:bg-gray-100');
            });
            event.target.classList.add('bg-blue-500', 'text-white');
            event.target.classList.remove('text-gray-600');
            event.target.classList.remove('hover:bg-gray-100');

            // Show or hide additional fields based on role
            if (roleName === 'Caregiver') {
                document.getElementById('caregiver-fields').classList.remove('hidden');
            } else {
                document.getElementById('caregiver-fields').classList.add('hidden');
            }
        }

        // Initialize fields based on the default selected role
        document.addEventListener('DOMContentLoaded', function() {
            var roleId = document.getElementById('role_id').value;
            var roleName = document.querySelector('.flex a.bg-blue-500').innerText.trim();
            if (roleName === 'Caregiver') {
                document.getElementById('caregiver-fields').classList.remove('hidden');
            }
        });
    </script>
</x-guest-layout>
