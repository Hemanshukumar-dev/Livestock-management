@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-semibold">My Dashboard</h2>
            @if (! $owner)
                <p class="mt-4 text-sm text-slate-600">No owner profile found for this account.</p>
            @else
                <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="col-span-1 rounded-lg border border-slate-100 bg-sky-50 p-4">
                        <p class="text-xs text-slate-600">Owner</p>
                        <p class="mt-1 font-semibold text-slate-900">{{ $owner->name }}</p>
                        <p class="mt-2 text-sm text-slate-700">Code: <span class="font-mono text-sm text-slate-800">{{ $owner->owner_code }}</span></p>
                    </div>

                    <div class="col-span-1 rounded-lg border border-slate-100 bg-white p-4">
                        <p class="text-xs text-slate-600">Total Livestock</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">{{ $owner->livestock->count() }}</p>
                    </div>

                    <div class="col-span-1 rounded-lg border border-slate-100 bg-white p-4">
                        <p class="text-xs text-slate-600">Contact</p>
                        <p class="mt-1 text-sm text-slate-800">{{ $owner->phone }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-md font-semibold">My Animals</h3>

                    @if ($owner->livestock->isEmpty())
                        <div class="mt-4 rounded-lg border border-dashed border-slate-200 bg-white p-6 text-center text-slate-600">
                            No livestock registered yet.
                        </div>
                    @else
                        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($owner->livestock as $animal)
                                <div class="rounded-lg border bg-white p-4 shadow-sm">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800">{{ $animal->type }} @if($animal->breed) · <span class="text-sm font-medium text-slate-600">{{ $animal->breed }}</span> @endif</p>
                                            <p class="mt-2 text-xs text-slate-600">Tag: <span class="font-mono text-sm text-slate-800">{{ $animal->tag_number }}</span></p>
                                        </div>
                                        @php
                                            $status = $animal->health_status;
                                            $color = match($status) {
                                                'Healthy' => 'bg-emerald-100 text-emerald-700',
                                                'Sick' => 'bg-red-100 text-red-700',
                                                'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                                'Hospitalized' => 'bg-slate-100 text-slate-800',
                                                'Injured' => 'bg-amber-100 text-amber-800',
                                                default => 'bg-slate-100 text-slate-800',
                                            };
                                        @endphp
                                        <span class="ml-3 inline-flex items-center rounded-full px-3 py-1 text-xs font-medium {{ $color }}">{{ $status }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Owner Dashboard')

@section('content')
    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-sky-600">My Records</p>
            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Owner dashboard</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Review your livestock and add treatment or health history without leaving your dashboard.</p>
        </div>
    </div>

    @if (! $owner)
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <h3 class="text-xl font-semibold text-slate-900">Owner profile not linked yet</h3>
            <p class="mt-2 text-sm text-slate-600">Your user account is active, but an owner record has not been linked by an administrator.</p>
        </div>
    @else
        @php($historyCount = $owner->livestock->sum(fn ($animal) => $animal->histories->count()))

        <div class="mb-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Owner</p>
                <h3 class="mt-3 text-2xl font-semibold text-slate-900">{{ $owner->name }}</h3>
                <p class="mt-2 text-sm text-slate-600">Code: {{ $owner->owner_code }}</p>
                <p class="mt-1 text-sm text-slate-600">Phone: {{ $owner->phone }}</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Livestock</p>
                <h3 class="mt-3 text-4xl font-bold text-slate-900">{{ $owner->livestock->count() }}</h3>
                <p class="mt-2 text-sm text-slate-600">Animals linked to your account</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">History</p>
                <h3 class="mt-3 text-4xl font-bold text-slate-900">{{ $historyCount }}</h3>
                <p class="mt-2 text-sm text-slate-600">Recorded events across all livestock</p>
            </div>
        </div>

        <div class="space-y-6">
            @forelse ($owner->livestock as $animal)
                <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <div class="flex flex-col gap-4 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Livestock</p>
                            <h3 class="mt-1 text-2xl font-semibold text-slate-900">{{ $animal->type }} <span class="text-slate-500">({{ $animal->breed ?? 'N/A' }})</span></h3>
                            <p class="mt-1 text-sm text-slate-500">Tag: {{ $animal->tag_number }} · Source: {{ $animal->source }} · Added: {{ $animal->date_added?->format('d M Y') ?? 'N/A' }}</p>
                        </div>

                        <span class="rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 shadow-sm">{{ $animal->health_status }}</span>
                    </div>

                    <div class="px-6 py-5">
                        <details class="rounded-2xl border border-slate-200 bg-slate-50 p-4" open>
                            <summary class="cursor-pointer list-none text-sm font-semibold text-slate-800">History</summary>

                            <div class="mt-4 space-y-3">
                                @forelse ($animal->histories as $history)
                                    <div class="rounded-xl bg-white px-3 py-2 text-sm text-slate-700 shadow-sm">
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

                                <form method="POST" action="{{ route('livestock.histories.store', $animal->id) }}" class="mt-4 space-y-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                                    @csrf
                                    <div class="grid gap-3 md:grid-cols-3">
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

                                        <div>
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
                    </div>
                </section>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h3 class="text-xl font-semibold text-slate-900">No livestock linked yet</h3>
                    <p class="mt-2 text-sm text-slate-600">Your administrator has not attached livestock records to this account yet.</p>
                </div>
            @endforelse
        </div>
    @endif
@endsection
