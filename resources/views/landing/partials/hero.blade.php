<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center relative overflow-hidden pt-20">


    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('{{ asset('images/sk.png') }}');">
   <img src="{{ asset('images/sk.png') }}" alt="Barangay Background" class="w-full h-full object-cover">


    <div class="absolute inset-0 bg-gradient-to-br from-sk-darkgreen/95 to-sk-green/85"></div>
</div>


    <!-- Decorative shapes -->
    <div class="absolute top-20 left-10 w-64 h-64 bg-sk-yellow opacity-20 rounded-full mix-blend-screen filter blur-3xl z-0"></div>
    <div class="absolute bottom-20 right-10 w-72 h-72 bg-emerald-400 opacity-20 rounded-full mix-blend-screen filter blur-3xl z-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-12">
        <div class="md:w-1/2 pt-10 md:pt-0">
            <div class="inline-block px-4 py-1.5 rounded-full bg-sk-yellow/90 text-sk-darkgreen font-semibold text-sm mb-6 fade-in-up shadow-sm">
                <i class="fas fa-star mr-2"></i>Empowering the Youth
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 fade-in-up delay-100">
                Shaping Tomorrow's <span class="text-sk-yellow">Leaders</span> Today.
            </h1>
            <p class="text-lg md:text-xl text-emerald-50 mb-10 fade-in-up delay-200 max-w-2xl mx-auto md:mx-0 leading-relaxed">
                Welcome to the official portal of SK Barangay Poblacion. Join us in building a vibrant, inclusive, and progressive community for the youth.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start fade-in-up delay-300">
                <a href="#projects" class="px-8 py-4 rounded-full bg-sk-yellow text-sk-darkgreen font-bold text-lg hover:bg-yellow-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center">
                    Explore Projects <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="#about" class="px-8 py-4 rounded-full bg-transparent border-2 border-white text-white font-bold text-lg hover:bg-white/10 hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                    Learn More
                </a>
            </div>
        </div>

        <div class="md:w-1/2 hidden md:block fade-in-up delay-200 relative">
            <div class="relative w-full aspect-square max-w-lg mx-auto">
                <div class="absolute inset-0 bg-sk-yellow rounded-3xl transform rotate-6 opacity-50 transition-transform hover:rotate-12 duration-500"></div>
                <img src="{{ asset('images/sk.png') }}" alt="Youth Community" class="absolute inset-0 w-full h-full object-cover bg-white rounded-3xl shadow-2xl border-4 border-white transform transition-transform hover:-translate-y-2 duration-500 z-10">
                <!-- Floating badge -->
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-xl z-20 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                    <div class="bg-sk-green p-3 rounded-full text-white">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Active Youth</p>
                        <p class="font-bold text-xl text-sk-darkgreen">1,200+</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
