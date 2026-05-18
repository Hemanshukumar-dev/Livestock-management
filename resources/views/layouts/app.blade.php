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
<body class="min-h-screen bg-slate-50 text-slate-800">
    @php $user = auth()->user(); @endphp
    <div class="min-h-screen">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2 group">
                        <span class="text-2xl transition group-hover:scale-110">🐄</span>
                        <h1 class="text-lg font-bold text-slate-800">Livestock System</h1>
                    </a>
                </div>

                {{-- Desktop Navigation --}}
                <nav class="hidden sm:flex items-center gap-2">
                    @auth
                        @if ($user?->isAdmin())
                            <a href="{{ route('dashboard') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('dashboard') ? 'bg-slate-100 text-slate-900' : '' }}">Dashboard</a>
                            <a href="{{ route('owners.index') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('owners.index') ? 'bg-slate-100 text-slate-900' : '' }}">Owners</a>
                            <a href="{{ route('livestock.index') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('livestock.*') ? 'bg-slate-100 text-slate-900' : '' }}">Livestock</a>
                            <a href="{{ route('schemes.index') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('schemes.*') ? 'bg-slate-100 text-slate-900' : '' }}">Schemes</a>
                        @else
                            <a href="{{ route('owner.dashboard') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('owner.dashboard') ? 'bg-slate-100 text-slate-900' : '' }}">My Dashboard</a>
                            <a href="{{ route('livestock.index') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('livestock.index') || request()->routeIs('livestock.show') ? 'bg-slate-100 text-slate-900' : '' }}">My Livestock</a>
                            <a href="{{ route('schemes.index') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('schemes.*') ? 'bg-slate-100 text-slate-900' : '' }}">Schemes</a>
                        @endif

                        {{-- Divider --}}
                        <div class="h-5 w-px bg-slate-300 mx-2"></div>

                        {{-- Profile & Logout --}}
                        <a href="{{ route('profile.edit') }}" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 {{ request()->routeIs('profile.*') ? 'bg-slate-100 text-slate-900' : '' }}">Profile</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg border border-transparent px-3.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-red-50 hover:text-red-700">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-sky-400 hover:text-sky-700">Login</a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-700">Register</a>
                    @endauth
                </nav>

                {{-- Mobile hamburger --}}
                <button type="button" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" class="sm:hidden rounded-lg border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>

            {{-- Mobile nav dropdown --}}
            <div id="mobile-nav" class="hidden sm:hidden border-t border-slate-100 bg-white px-4 py-3 space-y-2 shadow-sm">
                @auth
                    @if ($user?->isAdmin())
                        <a href="{{ route('dashboard') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('dashboard') ? 'bg-slate-50 text-slate-900' : '' }}">📊 Dashboard</a>
                        <a href="{{ route('owners.index') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('owners.index') ? 'bg-slate-50 text-slate-900' : '' }}">👥 Owners</a>
                        <a href="{{ route('livestock.index') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('livestock.*') ? 'bg-slate-50 text-slate-900' : '' }}">🐄 Livestock</a>
                        <a href="{{ route('schemes.index') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('schemes.*') ? 'bg-slate-50 text-slate-900' : '' }}">📜 Schemes</a>
                    @else
                        <a href="{{ route('owner.dashboard') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('owner.dashboard') ? 'bg-slate-50 text-slate-900' : '' }}">📊 My Dashboard</a>
                        <a href="{{ route('livestock.index') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('livestock.index') || request()->routeIs('livestock.show') ? 'bg-slate-50 text-slate-900' : '' }}">🐄 My Livestock</a>
                        <a href="{{ route('schemes.index') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('schemes.*') ? 'bg-slate-50 text-slate-900' : '' }}">📜 Schemes</a>
                    @endif

                    <div class="border-t border-slate-100 my-2"></div>

                    <a href="{{ route('profile.edit') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900 {{ request()->routeIs('profile.*') ? 'bg-slate-50 text-slate-900' : '' }}">⚙️ Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-red-400 hover:text-red-700 text-center">🚪 Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900">Login</a>
                    <a href="{{ route('register') }}" class="block rounded-lg bg-sky-600 px-4 py-2.5 text-sm font-semibold text-white text-center transition hover:bg-sky-700">Register</a>
                @endauth
            </div>
        </header>

        <main class="@yield('content_class', 'mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8')">
            @yield('content')
        </main>
    </div>
</body>
</html>
