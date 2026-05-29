<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Livestock System') }}</title>
        <meta name="description" content="Simple livestock management for everyday farmers.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', 'Figtree', system-ui, sans-serif; }
        </style>
    </head>
    <body class="min-h-screen bg-[#f8faf5] text-txt-100 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            {{-- Logo / Brand --}}
            <div class="mb-6 text-center">
                <a href="/" class="inline-flex items-center gap-2 group">
                    <span class="text-4xl transition group-hover:scale-110">🐄</span>
                    <span class="text-xl font-bold text-txt-100">Livestock System</span>
                </a>
            </div>

            {{-- Card --}}
            <div class="w-full sm:max-w-md px-8 py-8 bg-bg-100 border border-bg-300 shadow-lg overflow-hidden rounded-3xl">
                {{ $slot }}
            </div>

            {{-- Footer link --}}
            <p class="mt-6 text-sm text-txt-200">
                &copy; {{ date('Y') }} Livestock Management System
            </p>
        </div>
    </body>
</html>
