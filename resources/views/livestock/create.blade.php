@extends('layouts.app')

@section('title', 'Add New Livestock')

@section('content')
    {{-- Ambient Atmosphere --}}
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[40rem] h-[40rem] bg-stone-200/30 dark:bg-emerald-900/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] opacity-70"></div>
        <div class="absolute top-[40%] left-[-10%] w-[50rem] h-[50rem] bg-emerald-50/50 dark:bg-bg-300/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-60"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMSIvPjwvc3ZnPg==')] opacity-50 dark:opacity-20 mix-blend-overlay"></div>
    </div>

    <div class="max-w-4xl mx-auto pb-12 animate-[fadeUp_0.6s_ease-out_forwards]">
        {{-- Breadcrumb --}}
        <nav class="mb-8 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-txt-200 dark:text-stone-400">
            <a href="{{ route('livestock.index') }}" class="transition hover:text-emerald-700 dark:hover:text-emerald-400">Livestock</a>
            <span class="text-stone-300 dark:text-txt-200">/</span>
            <span class="text-txt-100 dark:text-white">Add New</span>
        </nav>

        {{-- Page Header --}}
        <div class="mb-10 relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-bg-200 dark:bg-bg-100 border border-bg-300 dark:border-white/10 text-txt-200 dark:text-stone-400 text-xs font-bold uppercase tracking-widest mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 dark:bg-emerald-500"></span>
                Registration
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-txt-100 dark:text-white leading-[1.1]">
                Register New Animal
            </h2>
            <p class="mt-3 text-base leading-relaxed text-txt-200 dark:text-stone-400 font-light">
                Enter the details of the new animal to add it to the system. @if($user->isAdmin()) You must assign it to an owner. @else It will be added to your account. @endif
            </p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-8 rounded-2xl border border-red-200/80 dark:border-red-500/20 bg-red-50 dark:bg-[#201010]/80 px-6 py-5 shadow-sm">
                <p class="font-bold text-sm text-red-800 dark:text-red-400 mb-3 flex items-center gap-2">
                    <span>⚠️</span> Please correct the following errors:
                </p>
                <ul class="list-disc list-inside space-y-1.5 text-sm text-red-700 dark:text-red-300/80 marker:text-red-400">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Create Form --}}
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-emerald-100 to-sky-100 dark:from-emerald-900/20 dark:to-sky-900/20 rounded-[2rem] blur-xl opacity-50 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 pointer-events-none"></div>
            
            <form method="POST" action="{{ route('livestock.store') }}" class="relative rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/85 backdrop-blur-xl shadow-sm overflow-hidden">
                @csrf

                <div class="p-6 sm:p-10 space-y-10">
                    
                    {{-- SECTION: Animal Identity --}}
                    <div>
                        <div class="mb-6 flex items-center gap-4">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-txt-100 dark:text-white">Animal Identity</h3>
                            <div class="h-px flex-1 bg-bg-200 dark:bg-bg-100"></div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            {{-- Tag Number --}}
                            <div class="sm:col-span-2">
                                <label for="create-tag" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                    Tag Number <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="create-tag"
                                    name="tag_number"
                                    value="{{ old('tag_number') }}"
                                    required
                                    placeholder="e.g. TAG-001"
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-2.5 text-sm font-mono text-txt-100 dark:text-white placeholder-stone-400 dark:placeholder-stone-500 transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                />
                                @error('tag_number')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Type --}}
                            <div>
                                <label for="create-type" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                    Livestock Type <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select
                                    id="create-type"
                                    name="type"
                                    required
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                >
                                    <option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Type</option>
                                    @foreach ($livestockTypes as $type => $breedsList)
                                        <option value="{{ $type }}" @selected(old('type') === $type) class="bg-bg-100 dark:bg-[#1a211e]">{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Breed --}}
                            <div>
                                <label for="create-breed" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">Breed</label>
                                <select
                                    id="create-breed"
                                    name="breed"
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                >
                                    <option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Breed (Optional)</option>
                                </select>
                                @error('breed')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: Health & Status --}}
                    <div>
                        <div class="mb-6 flex items-center gap-4">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-txt-100 dark:text-white">Health & Status</h3>
                            <div class="h-px flex-1 bg-bg-200 dark:bg-bg-100"></div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            {{-- Age --}}
                            <div>
                                <label for="create-age" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                    Age (years) <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input
                                    type="number"
                                    id="create-age"
                                    name="age"
                                    value="{{ old('age') }}"
                                    min="0"
                                    required
                                    placeholder="e.g. 2"
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-2.5 text-sm text-txt-100 dark:text-white placeholder-stone-400 dark:placeholder-stone-500 transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                />
                                @error('age')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Health Status --}}
                            <div>
                                <label for="create-health" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                    Health Status <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select
                                    id="create-health"
                                    name="health_status"
                                    required
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                >
                                    <option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Health Status</option>
                                    @foreach (['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'] as $status)
                                        <option value="{{ $status }}" @selected(old('health_status') === $status) class="bg-bg-100 dark:bg-[#1a211e]">
                                            <?php
                                                $emojis = [
                                                    'Healthy' => '✅', 'Sick' => '🤒', 'Under Treatment' => '💊',
                                                    'Hospitalized' => '🏥', 'Injured' => '🩹',
                                                ];
                                                $statusEmoji = $emojis[$status] ?? '✅';
                                            ?>
                                            {{ $statusEmoji }} {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('health_status')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: Registration Details --}}
                    <div>
                        <div class="mb-6 flex items-center gap-4">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-txt-100 dark:text-white">Registration Details</h3>
                            <div class="h-px flex-1 bg-bg-200 dark:bg-bg-100"></div>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            {{-- Owner Selection --}}
                            @if ($user->isAdmin())
                                <div class="sm:col-span-2">
                                    <label for="create-owner" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                        Owner Assignment <span class="text-red-500 dark:text-red-400">*</span>
                                    </label>
                                    <select
                                        id="create-owner"
                                        name="owner_id"
                                        required
                                        class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                    >
                                        <option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Owner</option>
                                        @foreach ($owners as $owner)
                                            <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id) class="bg-bg-100 dark:bg-[#1a211e]">
                                                {{ $owner->name }} ({{ $owner->owner_code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('owner_id')
                                        <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            {{-- Source --}}
                            <div>
                                <label for="create-source" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                    Source <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select
                                    id="create-source"
                                    name="source"
                                    required
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                >
                                    <option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Source</option>
                                    <option value="Born" @selected(old('source') === 'Born') class="bg-bg-100 dark:bg-[#1a211e]">🏠 Born on farm</option>
                                    <option value="Purchased" @selected(old('source') === 'Purchased') class="bg-bg-100 dark:bg-[#1a211e]">🛒 Purchased</option>
                                </select>
                                @error('source')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Date Added --}}
                            <div>
                                <label for="create-date" class="block text-sm font-semibold text-stone-700 dark:text-stone-300 mb-1.5">Date Added</label>
                                <input
                                    type="date"
                                    id="create-date"
                                    name="date_added"
                                    value="{{ old('date_added', date('Y-m-d')) }}"
                                    class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20"
                                />
                                @error('date_added')
                                    <p class="mt-1.5 text-xs font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="border-t border-stone-100 dark:border-white/5 bg-bg-200/80 dark:bg-bg-100/[0.02] p-6 sm:p-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <a
                        href="{{ route('livestock.index') }}"
                        class="inline-flex items-center justify-center rounded-full border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-6 py-2.5 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100"
                    >
                        ← Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-2.5 text-sm font-bold text-white shadow-sm transition-all hover:from-emerald-500 hover:to-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.3)] border border-emerald-500/50 focus:outline-none focus:ring-2 focus:ring-emerald-500/50"
                    >
                        Complete Registration
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const breedData = @json($livestockTypes);
            const typeSelect = document.getElementById('create-type');
            const breedSelect = document.getElementById('create-breed');
            const currentBreed = "{{ old('breed') }}";

            function updateBreeds() {
                const selectedType = typeSelect.value;
                breedSelect.innerHTML = '<option value="" class="bg-bg-100 dark:bg-[#1a211e]">Select Breed (Optional)</option>';
                
                if (selectedType && breedData[selectedType]) {
                    let foundCurrent = false;
                    breedData[selectedType].forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        option.className = "bg-bg-100 dark:bg-[#1a211e]";
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
                        option.className = "bg-bg-100 dark:bg-[#1a211e]";
                        option.selected = true;
                        breedSelect.appendChild(option);
                    }
                } else if (currentBreed) {
                    const option = document.createElement('option');
                    option.value = currentBreed;
                    option.textContent = currentBreed;
                    option.className = "bg-bg-100 dark:bg-[#1a211e]";
                    option.selected = true;
                    breedSelect.appendChild(option);
                }
            }

            typeSelect.addEventListener('change', updateBreeds);
            updateBreeds();
        });
    </script>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection
