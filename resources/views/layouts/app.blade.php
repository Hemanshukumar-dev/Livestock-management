<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Livestock Management System')</title>
    <meta name="description" content="Simple livestock management for everyday farmers. Track animals, health records, and ownership details without confusion.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', 'Figtree', system-ui, sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-[#f8faf5] text-gray-800">
    @php($user = auth()->user())
    <div class="min-h-screen">
        <header class="border-b border-green-100 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🐄</span>
                    <h1 class="text-lg font-semibold text-gray-800">Livestock System</h1>
                </div>

                <nav class="hidden sm:flex items-center gap-3">
                    @auth
                        @if ($user?->isAdmin())
                            <a href="{{ route('dashboard') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700 {{ request()->routeIs('dashboard') ? 'border-green-400 text-green-700 bg-green-50' : '' }}">Dashboard</a>
                            <a href="{{ route('owners.index') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700 {{ request()->routeIs('owners.*') ? 'border-green-400 text-green-700 bg-green-50' : '' }}">Owners</a>
                            <a href="{{ route('livestock.index') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700 {{ request()->routeIs('livestock.*') ? 'border-green-400 text-green-700 bg-green-50' : '' }}">Livestock</a>
                            <a href="{{ route('owners.create') }}" class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700">Add Owner</a>
                        @else
                            <a href="{{ route('owner.dashboard') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700 {{ request()->routeIs('owner.dashboard') ? 'border-green-400 text-green-700 bg-green-50' : '' }}">My Dashboard</a>
                            <a href="{{ route('livestock.index') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700 {{ request()->routeIs('livestock.*') ? 'border-green-400 text-green-700 bg-green-50' : '' }}">My Livestock</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-red-400 hover:text-red-700">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-green-400 hover:text-green-700">Login</a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700">Register</a>
                    @endauth
                </nav>

                {{-- Mobile hamburger --}}
                <button type="button" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" class="sm:hidden rounded-lg border border-gray-200 p-2 text-gray-600 transition hover:bg-gray-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>

            {{-- Mobile nav dropdown --}}
            <div id="mobile-nav" class="hidden sm:hidden border-t border-green-100 bg-white px-4 py-3 space-y-2">
                @auth
                    @if ($user?->isAdmin())
                        <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">Dashboard</a>
                        <a href="{{ route('owners.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">Owners</a>
                        <a href="{{ route('livestock.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">Livestock</a>
                        <a href="{{ route('owners.create') }}" class="block rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white text-center transition hover:bg-green-700">Add Owner</a>
                    @else
                        <a href="{{ route('owner.dashboard') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">My Dashboard</a>
                        <a href="{{ route('livestock.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">My Livestock</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:border-red-400 hover:text-red-700 text-center">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-green-50 hover:text-green-700">Login</a>
                    <a href="{{ route('register') }}" class="block rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white text-center transition hover:bg-green-700">Register</a>
                @endauth
            </div>
        </header>

        <main class="@yield('content_class', 'mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8')">
            @yield('content')
        </main>
    </div>
</body>
</html>
