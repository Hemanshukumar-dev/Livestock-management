@extends('layouts.app')

@section('title', 'Livestock Records')

@section('content')
    @php $currentUser = auth()->user(); @endphp

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            <span class="mr-2">✅</span>{{ session('success') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">🐄 Livestock Registry</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                {{ $currentUser?->isAdmin() ? 'All Livestock Records' : 'My Livestock' }}
            </h2>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-600">
                Browse, search, and filter all registered animals. Click any animal to view full profile and health history.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="rounded-xl bg-sky-50 border border-sky-200 px-3 py-1.5 text-xs font-semibold text-sky-800">
                {{ $livestock->total() }} animal{{ $livestock->total() === 1 ? '' : 's' }} registered
            </span>
            <a href="{{ route('livestock.create') }}" class="rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500 shadow-sm flex items-center gap-2">
                <span>➕</span> Add Livestock
            </a>
        </div>
    </div>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('livestock.index') }}" class="mb-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="mb-4 flex items-center gap-2">
            <span class="text-lg">🔍</span>
            <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Search & Filter</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div>
                <label for="filter-tag" class="block text-sm font-medium text-slate-700">Tag Number</label>
                <input type="text" id="filter-tag" name="tag_number" value="{{ request('tag_number') }}" placeholder="e.g. TAG-001" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20" />
            </div>

            @if ($currentUser?->isAdmin())
                <div>
                    <label for="filter-owner" class="block text-sm font-medium text-slate-700">Owner Name</label>
                    <input type="text" id="filter-owner" name="owner_name" value="{{ request('owner_name') }}" placeholder="Search owner..." class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20" />
                </div>
                <div>
                    <label for="filter-code" class="block text-sm font-medium text-slate-700">Owner Code</label>
                    <input type="text" id="filter-code" name="owner_code" value="{{ request('owner_code') }}" placeholder="e.g. OWN001" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20" />
                </div>
            @endif

            <div>
                <label for="filter-type" class="block text-sm font-medium text-slate-700">Livestock Type</label>
                <select id="filter-type" name="type" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">All Types</option>
                    @foreach ($livestockTypes as $type)
                        <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter-breed" class="block text-sm font-medium text-slate-700">Breed</label>
                <select id="filter-breed" name="breed" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">All Breeds</option>
                    @foreach ($breeds as $breed)
                        <option value="{{ $breed }}" {{ request('breed') === $breed ? 'selected' : '' }}>{{ $breed }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="filter-health" class="block text-sm font-medium text-slate-700">Health Status</label>
                <select id="filter-health" name="health_status" class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">All Statuses</option>
                    @foreach ($healthStatuses as $status)
                        <option value="{{ $status }}" {{ request('health_status') === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button type="submit" class="flex-1 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/50">Search</button>
                <a href="{{ route('livestock.index') }}" class="flex-1 rounded-lg border border-slate-300 bg-white px-4 py-2 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">Clear</a>
            </div>
        </div>
    </form>

    {{-- Content --}}
    @if ($livestock->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <div class="text-5xl mb-4">🐑</div>
            @if (request()->hasAny(['tag_number', 'owner_name', 'owner_code', 'type', 'breed', 'health_status']))
                <h3 class="text-xl font-bold text-slate-900">No livestock found</h3>
                <p class="mt-2 text-sm text-slate-600">No animals match your search or filter criteria. Try adjusting your filters.</p>
                <a href="{{ route('livestock.index') }}" class="mt-6 inline-flex rounded-xl bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-500">Clear Filters</a>
            @else
                <h3 class="text-xl font-bold text-slate-900">No livestock registered yet</h3>
                <p class="mt-2 text-sm text-slate-600">Livestock entries will appear here once owners and their animals are added to the system.</p>
            @endif
        </div>
    @else
        {{-- Desktop Table --}}
        <div class="hidden lg:block overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm h-[600px] overflow-y-auto">
            <div class="overflow-x-auto h-full relative">
                <table class="w-full text-left text-sm relative">
                    <thead class="sticky top-0 z-10">
                        <tr class="border-b border-slate-200 bg-slate-50 backdrop-blur-sm">
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Tag</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Type</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Breed</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Age</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Health</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Owner</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500">Code</th>
                            <th class="px-5 py-3.5 text-xs font-semibold uppercase tracking-[0.1em] text-slate-500 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($livestock as $animal)
                            <?php
                                $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                $statusClasses = [
                                    'Healthy' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'Sick' => 'bg-red-100 text-red-700 border-red-200',
                                    'Under Treatment' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'Hospitalized' => 'bg-slate-200 text-slate-800 border-slate-300',
                                    'Injured' => 'bg-amber-100 text-amber-800 border-amber-200',
                                    ][$animal->health_status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
                                $statusDot = [
                                    'Healthy' => 'bg-emerald-500', 'Sick' => 'bg-red-500',
                                    'Under Treatment' => 'bg-yellow-500', 'Hospitalized' => 'bg-slate-500',
                                    'Injured' => 'bg-amber-500', ][$animal->health_status] ?? 'bg-slate-400';
                            ?>
                            <tr class="transition hover:bg-sky-50/50 cursor-pointer group" onclick="window.location='{{ route('livestock.show', $animal->id) }}'">
                                <td class="px-5 py-3 font-mono font-medium text-slate-900">{{ $animal->tag_number }}</td>
                                <td class="px-5 py-3 text-slate-800">
                                    <span class="inline-flex items-center gap-1.5">{{ $typeIcon }} {{ $animal->type }}</span>
                                </td>
                                <td class="px-5 py-3 text-slate-600">{{ $animal->breed ?? '—' }}</td>
                                <td class="px-5 py-3 text-slate-600">
                                    @if ($animal->age !== null)
                                        {{ $animal->age }}y
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider {{ $statusClasses }}">
                                        <span class="h-1.5 w-1.5 rounded-full {{ $statusDot }}"></span>
                                        {{ $animal->health_status }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 text-slate-700">{{ $animal->owner?->name ?? '—' }}</td>
                                <td class="px-5 py-3">
                                    <?php $ownerCode = $animal->owner?->owner_code; ?>
                                    @if ($ownerCode)
                                        <span class="rounded-full bg-sky-50 border border-sky-200 px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-sky-700">{{ $ownerCode }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-5 py-3 text-center" onclick="event.stopPropagation()">
                                    <div class="flex items-center justify-center gap-1 opacity-0 transition group-hover:opacity-100">
                                        <a href="{{ route('livestock.show', $animal->id) }}" class="p-1.5 text-slate-400 hover:text-sky-600 transition" title="View Profile">👁️</a>
                                        <?php $canEdit = $currentUser?->isAdmin() || ($currentUser?->isOwner() && $animal->owner?->user_id === $currentUser->id); ?>
                                        @if ($canEdit)
                                            <a href="{{ route('livestock.edit', $animal->id) }}" class="p-1.5 text-slate-400 hover:text-amber-600 transition" title="Edit">✏️</a>
                                        @endif
                                        @if ($currentUser?->isAdmin())
                                            <form method="POST" action="{{ route('livestock.destroy', $animal->id) }}" class="inline" onsubmit="return false;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openDeleteModal(this.closest('form'))" class="p-1.5 text-slate-400 hover:text-red-600 transition" title="Delete">🗑️</button>
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
                <?php
                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                    $mobileStatus = [
                        'Healthy' => 'bg-emerald-100 text-emerald-700',
                        'Sick' => 'bg-red-100 text-red-700',
                        'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                        'Hospitalized' => 'bg-slate-200 text-slate-800',
                        'Injured' => 'bg-amber-100 text-amber-800',
                        ][$animal->health_status] ?? 'bg-slate-100 text-slate-600';
                ?>
                <a href="{{ route('livestock.show', $animal->id) }}" class="block rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:shadow-md hover:border-sky-300">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="font-mono text-sm font-bold text-slate-900">{{ $animal->tag_number }}</span>
                                <span class="rounded-full px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider {{ $mobileStatus }}">{{ $animal->health_status }}</span>
                            </div>
                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                {{ $typeIcon }} {{ $animal->type }}
                                @if ($animal->breed)
                                    <span class="text-slate-500 font-normal">· {{ $animal->breed }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-2 gap-x-4 gap-y-1.5 text-xs text-slate-600">
                        <span><span class="font-medium text-slate-400">Age:</span> {{ $animal->age !== null ? $animal->age . 'y' : '—' }}</span>
                        <span><span class="font-medium text-slate-400">Owner:</span> {{ $animal->owner?->name ?? '—' }}</span>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $livestock->links() }}
        </div>
    @endif

    {{-- Delete Modal --}}
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-sm rounded-2xl border border-slate-200 bg-white p-6 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-2xl">⚠️</div>
                <h3 class="mt-4 text-lg font-bold text-slate-900">Delete Livestock</h3>
                <p class="mt-1 text-sm text-slate-600">Are you sure you want to delete this animal record? This action cannot be undone.</p>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</button>
                <button type="button" id="confirm-delete-btn" class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Logic
            let activeDeleteForm = null;
            window.openDeleteModal = function(form) {
                activeDeleteForm = form;
                const modal = document.getElementById('delete-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };
            window.closeDeleteModal = function() {
                activeDeleteForm = null;
                const modal = document.getElementById('delete-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };
            document.getElementById('confirm-delete-btn').addEventListener('click', function () {
                if (activeDeleteForm) activeDeleteForm.submit();
            });
            document.getElementById('delete-modal').addEventListener('click', function (e) {
                if (e.target === this) window.closeDeleteModal();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') window.closeDeleteModal();
            });

            // Dynamic Breed Filtering
            const typeSelect = document.getElementById('filter-type');
            const breedSelect = document.getElementById('filter-breed');
            const currentBreed = '{{ request('breed') }}';

            const breedMap = {
                'Cow': ['Gir','Sahiwal','Red Sindhi','Tharparkar','Holstein Friesian','Jersey'],
                'Buffalo': ['Murrah','Nili-Ravi','Jaffarabadi','Surti','Mehsana'],
                'Goat': ['Jamunapari','Boer','Beetal','Barbari','Sirohi'],
                'Sheep': ['Merino','Suffolk','Dorper','Rambouillet','Deccani'],
                'Poultry': ['Broiler','Layer','Desi Chicken','Kadaknath','Rhode Island Red']
            };

            function updateBreeds() {
                const selectedType = typeSelect.value;
                breedSelect.innerHTML = '<option value="">All Breeds</option>';

                if (selectedType && breedMap[selectedType]) {
                    breedMap[selectedType].forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        if (currentBreed === breed) {
                            option.selected = true;
                        }
                        breedSelect.appendChild(option);
                    });
                } else if (!selectedType) {
                    // If no type selected, show all breeds
                    Object.values(breedMap).flat().forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        if (currentBreed === breed) {
                            option.selected = true;
                        }
                        breedSelect.appendChild(option);
                    });
                }
            }

            if (typeSelect && breedSelect) {
                typeSelect.addEventListener('change', updateBreeds);
                // Initialize on load
                updateBreeds();
            }
        });
    </script>
@endsection
