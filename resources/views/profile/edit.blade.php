@extends('layouts.user')

@section('header_title', 'Profile Settings')

@section('content')
    <!-- Status Messages -->
    @if(session('success') || session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-8 rounded shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-2 text-emerald-600"></i>
            {{ session('success') ?? 'Settings updated successfully.' }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-8 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-10">

        <!-- SK ID DETAILS UPDATE SECTION (Social Media Profile Style) -->
        @php
            $skId = \App\Models\SkIdRequest::where('user_id', auth()->id())->latest()->first();
        @endphp

        @if($skId)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Social Media "Cover Photo" Banner -->
            <div class="h-36 bg-gradient-to-r from-sk-darkgreen to-sk-green relative">
                <div class="absolute inset-0 bg-[url('{{ asset('images/id.png') }}')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            </div>

            <div class="px-6 md:px-10 pb-8">
                <form action="{{ route('sk_id.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Header (Avatar & Name) -->
                    <div class="flex flex-col md:flex-row items-center md:items-end gap-6 -mt-16 mb-8 border-b border-gray-100 pb-8">

                        <!-- Profile Avatar with Hover Overlay -->
                        <div class="relative group z-10 shrink-0">
                            <div class="w-32 h-32 rounded-full border-[5px] border-white shadow-md overflow-hidden bg-white">
                                <img id="profile-preview" src="{{ asset($skId->id_photo_path) }}" alt="Profile" class="w-full h-full object-cover">
                            </div>
                            <!-- Hover to change camera icon -->
                            <label for="id_photo" class="absolute inset-0 bg-black/60 rounded-full flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity duration-200">
                                <i class="fas fa-camera text-2xl"></i>
                                <span class="text-[10px] font-bold mt-1 tracking-wider uppercase">Change</span>
                            </label>
                        </div>

                        <!-- Name & Title -->
                        <div class="text-center md:text-left flex-grow mb-2">
                            <h2 class="text-2xl md:text-3xl font-black text-gray-900 leading-none">{{ $skId->first_name }} {{ $skId->last_name }}</h2>
                            <p class="text-sm text-gray-500 font-bold mt-2 uppercase tracking-wide flex items-center justify-center md:justify-start gap-1.5">
                                <i class="fas fa-check-circle text-sk-green"></i> Youth Registry Profile
                            </p>
                        </div>

                        <!-- Visible Upload Button -->
                        <div class="shrink-0 mb-2">
                            <label for="id_photo" class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-bold rounded-lg cursor-pointer transition-colors shadow-sm border border-gray-200 w-full md:w-auto">
                                <i class="fas fa-image mr-2 text-gray-600"></i> Change ID Photo
                            </label>
                            <!-- Hidden actual file input -->
                            <input type="file" id="id_photo" name="id_photo" accept="image/*" class="hidden" onchange="previewProfileImage(event)">
                        </div>
                    </div>

                    <!-- Warning Note -->
                    <div class="mb-8 bg-amber-50/80 rounded-lg p-4 border border-amber-200 flex gap-3">
                        <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                        <p class="text-sm text-amber-800 leading-relaxed">
                            Keep your official youth registry details up to date.
                            <span class="font-bold text-amber-600">Note: Changing details on an approved ID will temporarily revert it to "Pending" for admin verification.</span>
                        </p>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $skId->first_name) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $skId->last_name) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob', $skId->dob->format('Y-m-d')) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20 text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                            <select name="gender" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20 text-gray-600">
                                <option value="Male" {{ $skId->gender === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $skId->gender === 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <!-- Structured Address Section -->
                        <div class="md:col-span-2">
                            <h4 class="font-bold text-gray-900 text-sm mb-3">Complete Address</h4>

                            <!-- Hidden actual address field sent to the database -->
                            <input type="hidden" name="address" id="full_address" value="{{ old('address', $skId->address) }}">

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Sitio / Purok</label>
                                    <select id="sitio_selector" onchange="updateFullAddress()" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20 text-gray-700 font-medium">
                                        <option value="">Select...</option>
                                        <option value="Purok Ilang-Ilang 1">Purok Ilang-Ilang 1</option>
                                        <option value="Purok Ilang-Ilang 2">Purok Ilang-Ilang 2</option>
                                        <option value="Sitio Lugan">Sitio Lugan</option>
                                        <option value="Sitio Tabite / Tabiti">Sitio Tabite / Tabiti</option>
                                        <option value="Sitio Tboli Village">Sitio Tboli Village</option>
                                        <option value="Segundo Village">Segundo Village</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Barangay</label>
                                    <input type="text" value="Poblacion" readonly class="w-full rounded-md border-gray-200 bg-gray-100 text-gray-500 font-bold cursor-not-allowed select-none">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Municipality</label>
                                    <input type="text" value="Lake Sebu" readonly class="w-full rounded-md border-gray-200 bg-gray-100 text-gray-500 font-bold cursor-not-allowed select-none">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 uppercase mb-1">Province</label>
                                    <input type="text" value="South Cotabato" readonly class="w-full rounded-md border-gray-200 bg-gray-100 text-gray-500 font-bold cursor-not-allowed select-none">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Your Contact Number</label>
                            <input type="text" name="contact_number" value="{{ old('contact_number', $skId->contact_number) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>

                        <!-- Emergency Contact Section -->
                        <div class="md:col-span-2 mt-4 pt-6 border-t border-gray-100">
                            <h4 class="font-black text-gray-900 text-lg mb-6">Emergency Contact</h4>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Contact Name</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $skId->emergency_contact_name) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Contact Number</label>
                            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number', $skId->emergency_contact_number) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>
                        <!-- ADD THIS NEW BLOCK -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Emergency Contact Address</label>
                            <input type="text" name="emergency_contact_address" value="{{ old('emergency_contact_address', $skId->emergency_contact_address ?? 'Poblacion, Lake Sebu, South Cotabato') }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 pt-6 border-t border-gray-100">
                        <button type="submit" class="px-8 py-3 bg-sk-green hover:bg-sk-darkgreen text-white font-bold rounded-lg transition-colors shadow-md flex items-center gap-2">
                            <i class="fas fa-save"></i> Save ID Details
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- ACCOUNT CREDENTIALS SECTION -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="border-b border-gray-100 pb-5 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-user-shield text-gray-600"></i> Account Credentials
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Update your login email and account display name.</p>
                </div>

                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Account Display Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        @error('name', 'userDeletion') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Login Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        @error('email', 'userDeletion') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-gray-800 hover:bg-black text-white font-bold rounded-lg transition-colors shadow-sm">
                            Save Credentials
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- PASSWORD SECTION -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="border-b border-gray-100 pb-5 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                        <i class="fas fa-key text-gray-600"></i> Change Password
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">Ensure your account is using a long, random password to stay secure.</p>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6 max-w-xl">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Current Password</label>
                        <input type="password" name="current_password" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        @error('current_password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">New Password</label>
                        <input type="password" name="password" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                        @error('password', 'updatePassword') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" required class="w-full rounded-md border-gray-300 focus:border-sk-green focus:ring focus:ring-sk-green/20">
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2.5 bg-gray-800 hover:bg-black text-white font-bold rounded-lg transition-colors shadow-sm">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        // Preview Profile Image on Upload
        function previewProfileImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profile-preview');
                output.src = reader.result;
            };
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Handle Address Assembly
        function updateFullAddress() {
            const sitio = document.getElementById('sitio_selector').value;
            if(sitio) {
                // Combines the dropdown choice with the locked fields
                document.getElementById('full_address').value = sitio + ' Poblacion Lake Sebu South Cotabato';
            } else {
                document.getElementById('full_address').value = '';
            }
        }

        // On Page Load: Pre-select the correct Sitio/Purok based on the existing database value
        document.addEventListener("DOMContentLoaded", function() {
            const currentAddress = document.getElementById('full_address').value;
            const selector = document.getElementById('sitio_selector');

            if(currentAddress) {
                for(let i = 0; i < selector.options.length; i++) {
                    const optionValue = selector.options[i].value;
                    if(optionValue !== '' && currentAddress.includes(optionValue)) {
                        selector.selectedIndex = i;
                        break;
                    }
                }
            }
        });
    </script>
    @endpush
@endsection
