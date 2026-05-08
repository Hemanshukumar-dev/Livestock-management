@extends('layouts.app')

@section('title', 'Owners')

@section('content')
    @php($currentUser = auth()->user())

    @if (session('success'))
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('credentials'))
        <div class="mb-8 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4 text-sm text-amber-900 shadow-sm">
            <p class="font-semibold">Owner credentials</p>
            <p class="mt-2">Email: <span class="font-mono">{{ session('credentials.email') }}</span></p>
            <p>Password: <span class="font-mono">{{ session('credentials.password') }}</span></p>
        </div>
    @endif

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-sky-600">Owner Records</p>
            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">All owners and their livestock</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Browse owner profiles and the livestock attached to each owner from a single clean interface.</p>
        </div>

        @if ($currentUser?->isAdmin())
            <a href="{{ route('owners.create') }}" class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-600/20 transition hover:bg-sky-500">
                Add New Owner
            </a>
        @endif
    </div>

    <!-- Search & Filter Section -->
    <form method="GET" action="{{ route('owners.index') }}" class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-4">
            <p class="text-sm font-semibold uppercase tracking-[0.15em] text-slate-500">Search & Filter</p>
        </div>
        
        <div class="grid gap-4 md:grid-cols-3 md:items-end">
            <!-- Search Input -->
            <div>
                <label for="search" class="block text-sm font-medium text-slate-700">Search by Owner Name</label>
                <input 
                    type="text" 
                    id="search"
                    name="search" 
                    value="{{ $search ?? '' }}"
                    placeholder="Enter owner name..."
                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                />
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-slate-700">Filter by Livestock Type</label>
                <select 
                    id="type"
                    name="type"
                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                >
                    <option value="">All Types</option>
                    @forelse ($livestockTypes as $livestockType)
                        <option value="{{ $livestockType }}" @selected(($type ?? '') === $livestockType)>
                            {{ $livestockType }}
                        </option>
                    @empty
                        <option disabled>No livestock types available</option>
                    @endforelse
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button 
                    type="submit"
                    class="flex-1 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500"
                >
                    Search
                </button>
                <a 
                    href="{{ route('owners.index') }}"
                    class="flex-1 rounded-lg border border-slate-300 bg-white px-4 py-2 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
                >
                    Clear
                </a>
            </div>
        </div>
    </form>

    @forelse ($owners as $owner)
        <section class="mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">{{ $owner->name }}</h3>
                    <p class="mt-1 inline-flex rounded-full bg-sky-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-sky-700">{{ $owner->owner_code }}</p>
                    <p class="mt-1 text-sm text-slate-500">Phone: {{ $owner->phone }}</p>
                    <p class="mt-1 text-sm text-slate-500">Address: {{ $owner->address }}</p>
                </div>
                <div class="flex flex-col items-start gap-3 sm:items-end">
                    <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-slate-600">
                        <span class="font-semibold text-slate-900">{{ $owner->livestock->count() }}</span> livestock record{{ $owner->livestock->count() === 1 ? '' : 's' }}
                    </div>

                    @if ($currentUser?->isAdmin() || ($currentUser?->isOwner() && $owner->user_id === $currentUser->id))
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('owners.edit', $owner->id) }}" class="inline-flex items-center justify-center rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('owners.destroy', $owner->id) }}" onsubmit="return confirm('Delete this owner and all related livestock?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="px-6 py-5">
                @if ($owner->livestock->isEmpty())
                    <p class="text-sm text-slate-500">No livestock registered for this owner yet.</p>
                @else
                    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($owner->livestock as $animal)
                            <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Livestock</p>
                                        <h4 class="mt-1 text-lg font-semibold text-slate-900">{{ $animal->type }}</h4>
                                    </div>
                                    @php
                                        $healthStatusClass = match ($animal->health_status) {
                                            'Healthy' => 'bg-emerald-100 text-emerald-700',
                                            'Sick' => 'bg-red-100 text-red-700',
                                            'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                            'Hospitalized' => 'bg-slate-100 text-slate-800',
                                            'Injured' => 'bg-amber-100 text-amber-800',
                                            default => 'bg-slate-100 text-slate-600',
                                        };
                                    @endphp
                                    <span class="rounded-full px-3 py-1 text-xs font-medium shadow-sm {{ $healthStatusClass }}">{{ $animal->health_status }}</span>
                                </div>

                                <dl class="mt-4 space-y-2 text-sm text-slate-600">
                                    <div class="flex justify-between gap-4">
                                        <dt class="font-medium text-slate-500">Breed</dt>
                                        <dd class="text-right text-slate-800">{{ $animal->breed ?? 'N/A' }}</dd>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <dt class="font-medium text-slate-500">Age</dt>
                                        <dd class="text-right text-slate-800">{{ $animal->age ?? 'N/A' }}</dd>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <dt class="font-medium text-slate-500">Health</dt>
                                        <dd class="text-right text-slate-800">{{ $animal->health_status }}</dd>
                                    </div>
                                    <div class="flex justify-between gap-4">
                                        <dt class="font-medium text-slate-500">Tag</dt>
                                        <dd class="text-right font-mono text-slate-800">{{ $animal->tag_number }}</dd>
                                    </div>
                                </dl>

                                <details class="mt-4 rounded-2xl border border-slate-200 bg-white/80 p-3">
                                    <summary class="cursor-pointer list-none text-sm font-semibold text-slate-800">History</summary>

                                    <div class="mt-3 space-y-3">
                                        <div class="space-y-2">
                                            @forelse ($animal->histories as $history)
                                                <div class="rounded-xl bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                                        <span class="font-semibold text-slate-900">{{ $history->event_type }} - {{ \Illuminate\Support\Carbon::parse($history->event_date)->format('d M Y') }}</span>
                                                    </div>
                                                    @if ($history->description)
                                                        <p class="mt-1 text-slate-600">{{ $history->description }}</p>
                                                    @endif
                                                </div>
                                            @empty
                                                <p class="text-sm text-slate-500">No history records yet</p>
                                            @endforelse
                                        </div>

                                        <form method="POST" action="{{ route('livestock.histories.store', $animal->id) }}" class="space-y-3 rounded-2xl border border-slate-200 bg-slate-50 p-3">
                                            @csrf
                                            <div class="grid gap-3 sm:grid-cols-3">
                                                <div>
                                                    <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-slate-500">Event Type</label>
                                                    <select name="event_type" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20" required>
                                                        <option value="">Select type</option>
                                                        <option value="Vaccination">Vaccination</option>
                                                        <option value="Treatment">Treatment</option>
                                                        <option value="Checkup">Checkup</option>
                                                        <option value="Illness">Illness</option>
                                                        <option value="Deworming">Deworming</option>
                                                        <option value="Surgery">Surgery</option>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-slate-500">Event Date</label>
                                                    <input type="date" name="event_date" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20" required>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label class="mb-1 block text-xs font-medium uppercase tracking-[0.15em] text-slate-500">Description</label>
                                                    <textarea name="description" rows="1" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20" placeholder="Short details"></textarea>
                                                </div>
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Add History</button>
                                            </div>
                                        </form>
                                    </div>
                                </details>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @empty
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            @if ($search || $type)
                <h3 class="text-xl font-semibold text-slate-900">No owners found</h3>
                <p class="mt-2 text-sm text-slate-600">No owners match your search or filter criteria. Try adjusting your filters.</p>
                <a href="{{ route('owners.index') }}" class="mt-6 inline-flex rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Clear Filters</a>
            @else
                <h3 class="text-xl font-semibold text-slate-900">No owners yet</h3>
                <p class="mt-2 text-sm text-slate-600">Create the first owner and livestock entry to start populating the database.</p>
                <a href="{{ route('owners.create') }}" class="mt-6 inline-flex rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Add New Owner</a>
            @endif
        </div>
    @endforelse
@endsection