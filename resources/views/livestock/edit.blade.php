@extends('layouts.app')

@section('title', 'Edit ' . $livestock->tag_number)

@section('content')
    @php $currentUser = auth()->user(); @endphp

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 text-sm text-txt-200">
        <a href="{{ route('livestock.index') }}" class="transition hover:text-green-700">Livestock</a>
        <span>/</span>
        <a href="{{ route('livestock.show', $livestock->id) }}" class="transition hover:text-green-700">{{ $livestock->tag_number }}</a>
        <span>/</span>
        <span class="font-medium text-txt-100">Edit</span>
    </nav>

    {{-- Page Header --}}
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">✏️ Edit Livestock</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-txt-100">
            Update {{ $livestock->tag_number }}
        </h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-txt-200">
            Update the details for this animal. Only this individual record will be modified — no other livestock will be affected.
        </p>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800 shadow-sm">
            <p class="font-semibold mb-2">⚠️ Please correct the following errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Form --}}
    <form method="POST" action="{{ route('livestock.update', $livestock->id) }}" class="rounded-3xl border border-bg-300 bg-bg-100 p-8 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Type --}}
            <div>
                <label for="edit-type" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Livestock Type <span class="text-red-500">*</span>
                </label>
                <select
                    id="edit-type"
                    name="type"
                    required
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Type</option>
                    @foreach ($livestockTypes as $type => $breedsList)
                        <option value="{{ $type }}" @selected(old('type', $livestock->type) === $type)>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Breed --}}
            <div>
                <label for="edit-breed" class="mb-1.5 block text-sm font-medium text-slate-700">Breed</label>
                <select
                    id="edit-breed"
                    name="breed"
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Breed (Optional)</option>
                </select>
                @error('breed')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
                
                <script>
                    const breedData = @json($livestockTypes);
                    const typeSelect = document.getElementById('edit-type');
                    const breedSelect = document.getElementById('edit-breed');
                    const currentBreed = "{{ old('breed', $livestock->breed) }}";

                    function updateBreeds() {
                        const selectedType = typeSelect.value;
                        breedSelect.innerHTML = '<option value="">Select Breed (Optional)</option>';
                        
                        if (selectedType && breedData[selectedType]) {
                            let foundCurrent = false;
                            breedData[selectedType].forEach(breed => {
                                const option = document.createElement('option');
                                option.value = breed;
                                option.textContent = breed;
                                if (breed === currentBreed) {
                                    option.selected = true;
                                    foundCurrent = true;
                                }
                                breedSelect.appendChild(option);
                            });
                            
                            if (currentBreed && !foundCurrent) {
                                const option = document.createElement('option');
                                option.value = currentBreed;
                                option.textContent = currentBreed;
                                option.selected = true;
                                breedSelect.appendChild(option);
                            }
                        } else if (currentBreed) {
                            const option = document.createElement('option');
                            option.value = currentBreed;
                            option.textContent = currentBreed;
                            option.selected = true;
                            breedSelect.appendChild(option);
                        }
                    }

                    typeSelect.addEventListener('change', updateBreeds);
                    // Initialize on load
                    updateBreeds();
                </script>
            </div>

            {{-- Age --}}
            <div>
                <label for="edit-age" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Age (years) <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="edit-age"
                    name="age"
                    value="{{ old('age', $livestock->age) }}"
                    min="0"
                    required
                    placeholder="0"
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('age')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Health Status --}}
            <div>
                <label for="edit-health" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Health Status <span class="text-red-500">*</span>
                </label>
                <select
                    id="edit-health"
                    name="health_status"
                    required
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    @foreach (['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'] as $status)
                        <option value="{{ $status }}" @selected(old('health_status', $livestock->health_status) === $status)>
                            <?php
                                $emojis = [
                                    'Healthy' => '✅',
                                    'Sick' => '🤒',
                                    'Under Treatment' => '💊',
                                    'Hospitalized' => '🏥',
                                    'Injured' => '🩹',
                                ];
                                $statusEmoji = $emojis[$status] ?? '✅';
                            ?>
                            {{ $statusEmoji }} {{ $status }}
                        </option>
                    @endforeach
                </select>
                @error('health_status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tag Number --}}
            <div>
                <label for="edit-tag" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Tag Number <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="edit-tag"
                    name="tag_number"
                    value="{{ old('tag_number', $livestock->tag_number) }}"
                    required
                    placeholder="e.g. TAG-001"
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm font-mono text-txt-100 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('tag_number')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Source --}}
            <div>
                <label for="edit-source" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Source <span class="text-red-500">*</span>
                </label>
                <select
                    id="edit-source"
                    name="source"
                    required
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="Born" @selected(old('source', $livestock->source) === 'Born')>🏠 Born on farm</option>
                    <option value="Purchased" @selected(old('source', $livestock->source) === 'Purchased')>🛒 Purchased</option>
                </select>
                @error('source')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date Added --}}
            <div>
                <label for="edit-date" class="mb-1.5 block text-sm font-medium text-slate-700">Date Added</label>
                <input
                    type="date"
                    id="edit-date"
                    name="date_added"
                    value="{{ old('date_added', $livestock->date_added ? \Illuminate\Support\Carbon::parse($livestock->date_added)->format('Y-m-d') : '') }}"
                    class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('date_added')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Owner Info (Read-only) --}}
        @if ($livestock->owner)
            <div class="mt-8 rounded-2xl border border-bg-300 bg-bg-200/50 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-txt-200 mb-3">Owner (cannot be changed here)</p>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-sm font-bold text-green-700">
                        {{ strtoupper(substr($livestock->owner->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-txt-100">{{ $livestock->owner->name }}</p>
                        <p class="text-xs text-txt-200">{{ $livestock->owner->owner_code }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Actions --}}
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-between">
            <a
                href="{{ route('livestock.show', $livestock->id) }}"
                class="inline-flex items-center justify-center rounded-xl border border-bg-300 bg-bg-100 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-bg-200"
            >
                ← Cancel
            </a>
            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-700 px-8 py-3 text-sm font-semibold text-white transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
            >
                💾 Save Changes
            </button>
        </div>
    </form>
@endsection
