<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SK Admin - Brgy. Poblacion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-sk-darkgreen text-white flex flex-col shadow-2xl flex-shrink-0">
        <!-- Changed border-emerald-800 to border-pink-800 -->
        <div class="h-20 flex items-center justify-center border-b border-pink-800 px-4 gap-3">
            <div
                class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-sk-green font-bold text-lg border-2 border-sk-yellow">
                SK
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-lg leading-tight text-sk-yellow">Poblacion</span>
                <!-- Changed text-emerald-200 to text-pink-300 -->
                <span class="text-[10px] uppercase tracking-widest text-pink-300">Admin Portal</span>
            </div>
        </div>

        <nav class="flex-grow p-4 space-y-2 overflow-y-auto">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-chart-line w-5 text-center"></i> Dashboard
            </a>

            <!-- Book Categories -->
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-book w-5 text-center"></i> Book Categories
            </a>

            <!-- Public Disclosure -->
            <a href="{{ route('admin.disclosure.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.disclosure.*') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-folder-open w-5 text-center"></i> Public Disclosure
            </a>

            <!-- Projects & Events -->
            <a href="{{ route('admin.projects.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-calendar-alt w-5 text-center"></i> Projects & Events
            </a>

            <!-- SK ID Requests -->
            <a href="{{ route('admin.sk_ids.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.sk_ids.*') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-id-card w-5 text-center"></i> SK ID Requests
            </a>

            <!-- Youth Registry -->
            <a href="{{ route('admin.youth_registry') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.youth_registry') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-users w-5 text-center"></i> Youth Registry
            </a>

            <!-- Suggestions Box -->
            <a href="{{ route('admin.suggestions') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.suggestions') ? 'bg-sk-green text-white shadow-md' : 'text-pink-100 hover:bg-pink-800 hover:text-white' }}">
                <i class="fas fa-lightbulb w-5 text-center"></i> Suggestions Box
            </a>

        </nav>

        <div class="p-4 border-t border-pink-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-300 hover:bg-red-500 hover:text-white font-medium transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Topbar -->
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10 flex-shrink-0">
            <h2 class="text-xl font-bold text-gray-800">@yield('header_title', 'Dashboard')</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-sk-green uppercase font-semibold">{{ Auth::user()->role }}</p>
                </div>
                <div
                    class="w-10 h-10 rounded-full bg-sk-yellow text-sk-darkgreen flex items-center justify-center font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50">
            @yield('content')
        </main>
    </div>
</body>

</html>
