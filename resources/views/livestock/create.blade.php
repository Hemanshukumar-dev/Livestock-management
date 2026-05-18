@extends('layouts.app')

@section('title', 'Add New Livestock')

@section('content')
    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 text-sm text-slate-500">
        <a href="{{ route('livestock.index') }}" class="transition hover:text-green-700">Livestock</a>
        <span>/</span>
        <span class="font-medium text-slate-800">Add New</span>
    </nav>

    {{-- Page Header --}}
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">➕ Add Livestock</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">
            Register New Animal
        </h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
            Enter the details of the new animal to add it to the system. @if($user->isAdmin()) You must assign it to an owner. @else It will be added to your account. @endif
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

    {{-- Create Form --}}
    <form method="POST" action="{{ route('livestock.store') }}" class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        @csrf

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @if ($user->isAdmin())
                {{-- Owner Selection --}}
                <div>
                    <label for="create-owner" class="mb-1.5 block text-sm font-medium text-slate-700">
                        Owner <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="create-owner"
                        name="owner_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    >
                        <option value="">Select Owner</option>
                        @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                                {{ $owner->name }} ({{ $owner->owner_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('owner_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- Type --}}
            <div>
                <label for="create-type" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Livestock Type <span class="text-red-500">*</span>
                </label>
                <select
                    id="create-type"
                    name="type"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Type</option>
                    @foreach ($livestockTypes as $type => $breedsList)
                        <option value="{{ $type }}" @selected(old('type') === $type)>{{ $type }}</option>
                    @endforeach
                </select>
                @error('type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Breed --}}
            <div>
                <label for="create-breed" class="mb-1.5 block text-sm font-medium text-slate-700">Breed</label>
                <select
                    id="create-breed"
                    name="breed"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Breed (Optional)</option>
                </select>
                @error('breed')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <script>
                    const breedData = @json($livestockTypes);
                    const typeSelect = document.getElementById('create-type');
                    const breedSelect = document.getElementById('create-breed');
                    const currentBreed = "{{ old('breed') }}";

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
                <label for="create-age" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Age (years) <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="create-age"
                    name="age"
                    value="{{ old('age') }}"
                    min="0"
                    required
                    placeholder="0"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('age')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Health Status --}}
            <div>
                <label for="create-health" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Health Status <span class="text-red-500">*</span>
                </label>
                <select
                    id="create-health"
                    name="health_status"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Health Status</option>
                    @foreach (['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'] as $status)
                        <option value="{{ $status }}" @selected(old('health_status') === $status)>
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
                <label for="create-tag" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Tag Number <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="create-tag"
                    name="tag_number"
                    value="{{ old('tag_number') }}"
                    required
                    placeholder="e.g. TAG-001"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm font-mono text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('tag_number')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Source --}}
            <div>
                <label for="create-source" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Source <span class="text-red-500">*</span>
                </label>
                <select
                    id="create-source"
                    name="source"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select Source</option>
                    <option value="Born" @selected(old('source') === 'Born')>🏠 Born on farm</option>
                    <option value="Purchased" @selected(old('source') === 'Purchased')>🛒 Purchased</option>
                </select>
                @error('source')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Date Added --}}
            <div>
                <label for="create-date" class="mb-1.5 block text-sm font-medium text-slate-700">Date Added</label>
                <input
                    type="date"
                    id="create-date"
                    name="date_added"
                    value="{{ old('date_added', date('Y-m-d')) }}"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('date_added')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-between">
            <a
                href="{{ route('livestock.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                ← Cancel
            </a>
            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-700 px-8 py-3 text-sm font-semibold text-white transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
            >
                ➕ Add Livestock
            </button>
        </div>
    </form>
@endsection
