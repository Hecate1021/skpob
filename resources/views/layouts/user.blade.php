<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('header_title', 'Kabataan Portal') - SK Brgy. Poblacion</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">

        <!-- Top Navigation for Youth Users -->
        <nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50 print:hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    <!-- Left side: Logo -->
                    <div class="flex items-center gap-6 md:gap-10">
                        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                            <img src="{{ asset('images/logo.jpg') }}" alt="SK Logo"
                                class="w-10 h-10 rounded-full object-cover bg-white border border-gray-200 group-hover:border-sk-green transition-colors shadow-sm">
                            <div class="hidden sm:block">
                                <h1 class="font-bold text-lg text-sk-green leading-tight">Brgy. Poblacion</h1>
                                <p class="text-[10px] text-gray-500 font-bold tracking-widest uppercase">Kabataan Portal</p>
                            </div>
                        </a>
                    </div>

                    <!-- Right side: User Dropdown Menu -->
                    <div class="relative" id="user-dropdown-container">

                        <!-- Dropdown Trigger Button -->
                        <button onclick="toggleDropdown()" class="flex items-center gap-2 text-sm font-bold text-gray-700 hover:text-sk-green transition-colors focus:outline-none bg-gray-50 hover:bg-gray-100 px-3 py-2 rounded-lg border border-gray-200">
                            <i class="fas fa-user-circle text-sk-green text-lg"></i>
                            <span class="hidden sm:inline">{{ Auth::user()->name ?? 'Youth User' }}</span>
                            <i class="fas fa-chevron-down text-xs ml-1 text-gray-400"></i>
                        </button>

                        <!-- Dropdown Menu Content -->
                        <div id="user-dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50 origin-top-right">
                            <div class="py-1">

                                <!-- Dashboard Link -->
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold transition-colors {{ request()->routeIs('dashboard') ? 'text-sk-green bg-pink-50' : 'text-gray-700 hover:text-sk-green hover:bg-pink-50' }}">
                                    <i class="fas fa-home w-4 text-center {{ request()->routeIs('dashboard') ? 'text-sk-green' : 'text-gray-400' }}"></i> Dashboard
                                </a>

                                <!-- Settings Link -->
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold transition-colors {{ request()->routeIs('profile.edit') ? 'text-sk-green bg-pink-50' : 'text-gray-700 hover:text-sk-green hover:bg-pink-50' }}">
                                    <i class="fas fa-cog w-4 text-center {{ request()->routeIs('profile.edit') ? 'text-sk-green' : 'text-gray-400' }}"></i> Settings
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-sign-out-alt w-4 text-center"></i> Log Out
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow w-full max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            <!-- Page Header Title -->
            <div class="mb-6 print:hidden">
                <h2 class="text-3xl font-extrabold text-gray-900">@yield('header_title')</h2>
            </div>

            @yield('content')
        </main>

        <!-- Simple Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 text-center text-sm text-gray-500 font-medium print:hidden">
            © {{ date('Y') }} Sangguniang Kabataan of Brgy. Poblacion. All rights reserved.
        </footer>
    </div>

    <!-- Dropdown Toggle Script -->
    <script>
        function toggleDropdown() {
            const menu = document.getElementById('user-dropdown-menu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside of it
        document.addEventListener('click', function(event) {
            const container = document.getElementById('user-dropdown-container');
            const menu = document.getElementById('user-dropdown-menu');

            if (container && menu && !container.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
