@extends('layouts.app')

@section('title', 'Livestock Records')

@section('content')
    @php($currentUser = auth()->user())

    {{-- Success Flash --}}
    @if (session('success'))
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            <span class="mr-2">✅</span>{{ session('success') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">🐄 Livestock Registry</p>
            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">
                {{ $currentUser?->isAdmin() ? 'All Livestock Records' : 'My Livestock' }}
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
                Browse, search, and filter all registered animals. Click any animal to view full profile and health history.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="rounded-2xl bg-green-50 border border-green-200 px-4 py-2 text-sm font-semibold text-green-800">
                {{ $livestock->total() }} animal{{ $livestock->total() === 1 ? '' : 's' }} registered
            </span>
        </div>
    </div>

    {{-- Search & Filter Section --}}
    <form method="GET" action="{{ route('livestock.index') }}" class="mb-8 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center gap-2">
            <span class="text-lg">🔍</span>
            <p class="text-sm font-semibold uppercase tracking-[0.15em] text-slate-500">Search & Filter</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            {{-- Tag Number --}}
            <div>
                <label for="filter-tag" class="block text-sm font-medium text-slate-700">Tag Number</label>
                <input
                    type="text"
                    id="filter-tag"
                    name="tag_number"
                    value="{{ request('tag_number') }}"
                    placeholder="e.g. TAG-001"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
            </div>

            {{-- Owner Name --}}
            @if ($currentUser?->isAdmin())
                <div>
                    <label for="filter-owner" class="block text-sm font-medium text-slate-700">Owner Name</label>
                    <input
                        type="text"
                        id="filter-owner"
                        name="owner_name"
                        value="{{ request('owner_name') }}"
                        placeholder="Search owner..."
                        class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                </div>

                {{-- Owner Code --}}
                <div>
                    <label for="filter-code" class="block text-sm font-medium text-slate-700">Owner Code</label>
                    <input
                        type="text"
                        id="filter-code"
                        name="owner_code"
                        value="{{ request('owner_code') }}"
                        placeholder="e.g. OWN001"
                        class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                </div>
            @endif

            {{-- Type --}}
            <div>
                <label for="filter-type" class="block text-sm font-medium text-slate-700">Livestock Type</label>
                <select
                    id="filter-type"
                    name="type"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">All Types</option>
                    @foreach ($livestockTypes as $type)
                        <option value="{{ $type }}" @selected(request('type') === $type)>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Breed --}}
            <div>
                <label for="filter-breed" class="block text-sm font-medium text-slate-700">Breed</label>
                <select
                    id="filter-breed"
                    name="breed"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">All Breeds</option>
                    @foreach ($breeds as $breed)
                        <option value="{{ $breed }}" @selected(request('breed') === $breed)>{{ $breed }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Health Status --}}
            <div>
                <label for="filter-health" class="block text-sm font-medium text-slate-700">Health Status</label>
                <select
                    id="filter-health"
                    name="health_status"
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">All Statuses</option>
                    @foreach ($healthStatuses as $status)
                        <option value="{{ $status }}" @selected(request('health_status') === $status)>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div class="flex items-end gap-3">
                <button
                    type="submit"
                    class="flex-1 rounded-lg bg-green-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
                >
                    Search
                </button>
                <a
                    href="{{ route('livestock.index') }}"
                    class="flex-1 rounded-lg border border-slate-300 bg-white px-4 py-2 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
                >
                    Clear
                </a>
            </div>
        </div>
    </form>

    {{-- Livestock Table (Desktop) / Cards (Mobile) --}}
    @if ($livestock->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <div class="text-5xl mb-4">🐑</div>
            @if (request()->hasAny(['tag_number', 'owner_name', 'owner_code', 'type', 'breed', 'health_status']))
                <h3 class="text-xl font-semibold text-slate-900">No livestock found</h3>
                <p class="mt-2 text-sm text-slate-600">No animals match your search or filter criteria. Try adjusting your filters.</p>
                <a href="{{ route('livestock.index') }}" class="mt-6 inline-flex rounded-full bg-green-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-green-600">Clear Filters</a>
            @else
                <h3 class="text-xl font-semibold text-slate-900">No livestock registered yet</h3>
                <p class="mt-2 text-sm text-slate-600">Livestock entries will appear here once owners and their animals are added to the system.</p>
            @endif
        </div>
    @else
        {{-- Desktop Table --}}
        <div class="hidden lg:block overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/80">
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Tag</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Type</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Breed</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Age</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Health</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Owner</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Code</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Date Added</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($livestock as $animal)
                            <tr class="transition hover:bg-green-50/40 cursor-pointer group" onclick="window.location='{{ route('livestock.show', $animal->id) }}'">
                                <td class="px-6 py-4 font-mono font-semibold text-slate-900">{{ $animal->tag_number }}</td>
                                <td class="px-6 py-4 text-slate-800">
                                    <span class="inline-flex items-center gap-1.5">
                                        @php
                                            $typeIcon = match(strtolower($animal->type)) {
                                                'cow', 'cattle' => '🐄',
                                                'goat' => '🐐',
                                                'sheep' => '🐑',
                                                'pig' => '🐖',
                                                'horse' => '🐴',
                                                'chicken', 'poultry' => '🐔',
                                                'duck' => '🦆',
                                                default => '🐾',
                                            };
                                        @endphp
                                        {{ $typeIcon }} {{ $animal->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-700">{{ $animal->breed ?? '—' }}</td>
                                <td class="px-6 py-4 text-slate-700">
                                    @if ($animal->age !== null)
                                        {{ $animal->age }} {{ $animal->age == 1 ? 'year' : 'years' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = match ($animal->health_status) {
                                            'Healthy' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'Sick' => 'bg-red-100 text-red-700 border-red-200',
                                            'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                                            'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                                            default => 'bg-slate-100 text-slate-600 border-slate-200',
                                        };
                                        $statusDot = match ($animal->health_status) {
                                            'Healthy' => 'bg-emerald-500',
                                            'Sick' => 'bg-red-500',
                                            'Under Treatment' => 'bg-yellow-500',
                                            'Hospitalized' => 'bg-slate-500',
                                            'Injured' => 'bg-amber-500',
                                            default => 'bg-slate-400',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-medium {{ $statusClasses }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $statusDot }}"></span>
                                        {{ $animal->health_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-medium">{{ $animal->owner?->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    @if ($animal->owner?->owner_code)
                                        <span class="rounded-full bg-sky-50 border border-sky-200 px-2.5 py-0.5 text-xs font-semibold text-sky-700">{{ $animal->owner->owner_code }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $animal->date_added ? \Illuminate\Support\Carbon::parse($animal->date_added)->format('d M Y') : '—' }}
                                </td>
                                <td class="px-6 py-4" onclick="event.stopPropagation()">
                                    <div class="flex items-center gap-2 opacity-0 transition group-hover:opacity-100">
                                        <a href="{{ route('livestock.show', $animal->id) }}" class="rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-200" title="View Profile">View</a>
                                        @if ($currentUser?->isAdmin() || ($currentUser?->isOwner() && $animal->owner?->user_id === $currentUser->id))
                                            <a href="{{ route('livestock.edit', $animal->id) }}" class="rounded-lg bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700 transition hover:bg-green-200" title="Edit">Edit</a>
                                        @endif
                                        @if ($currentUser?->isAdmin())
                                            <form method="POST" action="{{ route('livestock.destroy', $animal->id) }}" class="inline" onsubmit="return false;">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="button"
                                                    onclick="openDeleteModal(this.closest('form'))"
                                                    class="rounded-lg bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-200"
                                                    title="Delete"
                                                >Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile Cards --}}
        <div class="lg:hidden space-y-4">
            @foreach ($livestock as $animal)
                <a href="{{ route('livestock.show', $animal->id) }}" class="block rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md hover:border-green-300">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-mono text-sm font-bold text-slate-900">{{ $animal->tag_number }}</span>
                                @php
                                    $statusClasses = match ($animal->health_status) {
                                        'Healthy' => 'bg-emerald-100 text-emerald-700',
                                        'Sick' => 'bg-red-100 text-red-700',
                                        'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                        'Hospitalized' => 'bg-slate-200 text-slate-800',
                                        'Injured' => 'bg-amber-100 text-amber-800',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClasses }}">{{ $animal->health_status }}</span>
                            </div>
                            <p class="mt-1 text-base font-semibold text-slate-800">
                                @php
                                    $typeIcon = match(strtolower($animal->type)) {
                                        'cow', 'cattle' => '🐄',
                                        'goat' => '🐐',
                                        'sheep' => '🐑',
                                        'pig' => '🐖',
                                        'horse' => '🐴',
                                        'chicken', 'poultry' => '🐔',
                                        'duck' => '🦆',
                                        default => '🐾',
                                    };
                                @endphp
                                {{ $typeIcon }} {{ $animal->type }}
                                @if ($animal->breed)
                                    <span class="text-slate-500 font-normal">· {{ $animal->breed }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-1.5 text-sm text-slate-600">
                        <span><span class="font-medium text-slate-500">Age:</span> {{ $animal->age !== null ? $animal->age . ($animal->age == 1 ? ' year' : ' years') : '—' }}</span>
                        <span><span class="font-medium text-slate-500">Owner:</span> {{ $animal->owner?->name ?? '—' }}</span>
                        <span><span class="font-medium text-slate-500">Code:</span> {{ $animal->owner?->owner_code ?? '—' }}</span>
                        <span><span class="font-medium text-slate-500">Added:</span> {{ $animal->date_added ? \Illuminate\Support\Carbon::parse($animal->date_added)->format('d M Y') : '—' }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $livestock->links() }}
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl">⚠️</div>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Delete Livestock</h3>
                <p class="mt-2 text-sm text-slate-600">Are you sure you want to delete this animal record? This action cannot be undone. All health history for this animal will also be removed.</p>
            </div>
            <div class="mt-8 flex gap-3">
                <button
                    type="button"
                    onclick="closeDeleteModal()"
                    class="flex-1 rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="confirm-delete-btn"
                    class="flex-1 rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-500"
                >
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let activeDeleteForm = null;

        function openDeleteModal(form) {
            activeDeleteForm = form;
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            activeDeleteForm = null;
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function () {
            if (activeDeleteForm) {
                activeDeleteForm.submit();
            }
        });

        // Close modal on backdrop click
        document.getElementById('delete-modal').addEventListener('click', function (e) {
            if (e.target === this) closeDeleteModal();
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDeleteModal();
        });
    </script>
@endsection
