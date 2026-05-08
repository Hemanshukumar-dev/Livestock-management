@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-10">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-sky-600">System Overview</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Dashboard</h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Get a comprehensive overview of your livestock ownership database with key metrics and analytics.</p>
    </div>

    <!-- Main Stats Cards -->
    <div class="mb-10 grid gap-6 md:grid-cols-2">
        <!-- Total Owners Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Total Owners</p>
                    <p class="mt-3 text-4xl font-bold text-slate-900">{{ $totalOwners }}</p>
                    <p class="mt-2 text-sm text-slate-600">Registered livestock owners</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100">
                    <svg class="h-7 w-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 016-6H0a6 6 0 016 6z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Livestock Card -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Total Livestock</p>
                    <p class="mt-3 text-4xl font-bold text-slate-900">{{ $totalLivestock }}</p>
                    <p class="mt-2 text-sm text-slate-600">Registered animals</p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-100">
                    <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Livestock by Type and Health Status -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Livestock by Type -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-sm font-semibold uppercase tracking-[0.15em] text-slate-500">Distribution by Type</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Livestock Types</h3>
            </div>

            @if ($livestockByType->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($livestockByType as $item)
                        <div class="flex items-end gap-4">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-700">{{ $item->type }}</p>
                                <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-100">
                                    <div
                                        class="h-full rounded-full bg-gradient-to-r from-sky-500 to-sky-400"
                                        style="width: {{ $totalLivestock ? ($item->count / $totalLivestock) * 100 : 0 }}%"
                                    ></div>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">{{ $item->count }}</p>
                                <p class="text-xs text-slate-500">{{ $totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0 }}%</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-500">No livestock data available yet.</p>
            @endif
        </div>

        <!-- Livestock by Health Status -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-sm font-semibold uppercase tracking-[0.15em] text-slate-500">Distribution by Status</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Health Status</h3>
            </div>

            @if ($livestockByStatus->isNotEmpty())
                <div class="space-y-4">
                    @foreach ($livestockByStatus as $item)
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 flex-1">
                                @if ($item->health_status === 'Healthy')
                                    <span class="inline-block h-3 w-3 rounded-full bg-emerald-500"></span>
                                    <p class="text-sm font-medium text-slate-700">{{ $item->health_status }}</p>
                                @elseif ($item->health_status === 'Sick')
                                    <span class="inline-block h-3 w-3 rounded-full bg-red-500"></span>
                                    <p class="text-sm font-medium text-slate-700">{{ $item->health_status }}</p>
                                @elseif ($item->health_status === 'Injured')
                                    <span class="inline-block h-3 w-3 rounded-full bg-yellow-500"></span>
                                    <p class="text-sm font-medium text-slate-700">{{ $item->health_status }}</p>
                                @else
                                    <span class="inline-block h-3 w-3 rounded-full bg-slate-400"></span>
                                    <p class="text-sm font-medium text-slate-700">{{ $item->health_status }}</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">{{ $item->count }}</p>
                                <p class="text-xs text-slate-500">{{ $totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0 }}%</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-500">No livestock data available yet.</p>
            @endif
        </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-10 rounded-3xl border border-slate-200 bg-gradient-to-br from-slate-50 to-slate-100 p-8 text-center shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Ready to manage livestock?</h3>
        <p class="mt-2 text-sm text-slate-600">Browse all owners and their livestock, or add a new owner to the system.</p>
        <a href="{{ route('owners.index') }}" class="mt-4 inline-flex rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
            View All Owners
        </a>
    </div>
@endsection
