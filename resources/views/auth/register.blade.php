<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Personal Details -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <x-input-label for="first_name" value="First Name" />
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>
            <div>
                <x-input-label for="last_name" value="Last Name" />
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <x-input-label for="dob" value="Date of Birth" />
                <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required />
            </div>
            <div>
                <x-input-label for="gender" value="Gender" />
                <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Select...</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <x-input-label for="sitio" value="Sitio / Purok (Brgy. Poblacion)" />
            <select id="sitio" name="sitio" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select...</option>
                <option value="Purok Ilang-Ilang 1">Purok Ilang-Ilang 1</option>
                <option value="Purok Ilang-Ilang 2">Purok Ilang-Ilang 2</option>
                <option value="Sitio Lugan">Sitio Lugan</option>
                <option value="Sitio Tabite / Tabiti">Sitio Tabite / Tabiti</option>
                <option value="Sitio Tboli Village">Sitio Tboli Village</option>
                <option value="Segundo Village">Segundo Village</option>
            </select>
        </div>

        <div class="mb-4">
            <x-input-label for="contact_number" value="Contact Number" />
            <x-text-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" required />
        </div>

        <!-- Account Credentials -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <x-input-label for="email" value="Email Address" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                Already registered?
            </a>
            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
