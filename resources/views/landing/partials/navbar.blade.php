<!-- Navbar -->
<nav class="fixed top-0 w-full z-[100] bg-white shadow-md py-3 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-3">
                <img src="{{ asset('images/logo.jpg') }}" alt="SK Logo" class="w-12 h-12 rounded-full shadow-md border-2 border-sk-yellow object-contain bg-white">
                <div>
                    <h1 class="font-bold text-xl text-sk-darkgreen leading-tight">Brgy. Poblacion</h1>
                    <p class="text-[11px] text-gray-500 font-bold tracking-widest uppercase">Sangguniang Kabataan</p>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-600 hover:text-sk-green font-bold transition-colors">Home</a>
                <a href="#disclosure" class="text-gray-600 hover:text-sk-green font-bold transition-colors">Public Disclosure</a>
                <a href="#projects" class="text-gray-600 hover:text-sk-green font-bold transition-colors">Projects</a>
                <a href="#sk-id" class="text-gray-600 hover:text-sk-green font-bold transition-colors">SK ID</a>
                <a href="#about" class="text-gray-600 hover:text-sk-green font-bold transition-colors">About Us</a>

                <!-- Desktop Auth Links -->
                <div class="flex items-center gap-4 pl-6 border-l border-gray-200">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors shadow-sm text-sm flex items-center gap-2">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-sk-green transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-sk-green text-white font-bold rounded-lg hover:bg-sk-darkgreen transition-colors shadow-sm text-sm">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Mobile Menu Button (Uses direct onclick) -->
            <div class="md:hidden flex items-center">
                <button onclick="toggleMobileMenu()" class="text-gray-600 hover:text-sk-green focus:outline-none p-2 rounded-lg bg-gray-50 border border-gray-100 transition-colors">
                    <i id="mobile-menu-icon" class="fas fa-bars text-xl w-6 h-6 flex items-center justify-center"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Panel (Absolute positioned below the navbar) -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-white border-t border-gray-100 shadow-xl pb-4">
        <div class="px-4 pt-4 pb-2 space-y-2">
            <!-- Notice each link also calls toggleMobileMenu() to close it when tapped -->
            <a href="#home" onclick="toggleMobileMenu()" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-sk-green hover:bg-pink-50 rounded-xl transition-colors">
                <i class="fas fa-home w-6 text-center mr-2 text-gray-400"></i> Home
            </a>

            </a>
            <a href="#about" onclick="toggleMobileMenu()" class="block px-4 py-3 text-base font-bold text-gray-700 hover:text-sk-green hover:bg-pink-50 rounded-xl transition-colors">
                <i class="fas fa-info-circle w-6 text-center mr-2 text-gray-400"></i> About Us
            </a>

            <!-- Mobile Auth Links -->
            <div class="border-t border-gray-100 pt-4 mt-2 px-2">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block px-4 py-3 text-center text-base font-bold text-white bg-sk-green hover:bg-sk-darkgreen rounded-xl shadow-md transition-colors">
                            Go to Dashboard <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('login') }}" class="block px-4 py-3 text-center text-base font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-3 text-center text-base font-bold text-white bg-sk-green hover:bg-sk-darkgreen rounded-xl shadow-md transition-colors">
                                    Register
                                </a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Bulletproof Mobile Menu Script -->
<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('mobile-menu-icon');

        // Toggle the hidden class
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            // Change icon to 'X'
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            menu.classList.add('hidden');
            // Change icon back to hamburger
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
</script>
