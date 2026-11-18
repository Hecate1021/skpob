<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Portal - SK Makabataan</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-sk-green to-sk-darkgreen relative overflow-hidden">

            <!-- Background pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FBBF24 2px, transparent 2px); background-size: 30px 30px;"></div>

            <div class="relative z-10">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center text-sk-green font-bold text-4xl shadow-2xl border-4 border-sk-yellow group-hover:scale-105 transition-transform duration-300">
                        SK
                    </div>
                    <h2 class="text-white font-bold text-2xl tracking-wide mt-3 drop-shadow-md">Brgy. Makabataan</h2>
                    <p class="text-sk-lightyellow text-sm font-medium tracking-widest uppercase">Youth Portal</p>
                </a>
            </div>

            <!-- The white card where the forms sit -->
            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border-t-8 border-sk-yellow relative z-10">
                {{ $slot }}
            </div>

            <div class="mt-8 text-emerald-100/60 text-sm relative z-10">
                &copy; {{ date('Y') }} Sangguniang Kabataan. All rights reserved.
            </div>
        </div>
    </body>
</html>
