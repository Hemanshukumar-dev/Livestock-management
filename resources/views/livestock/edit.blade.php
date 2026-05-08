@extends('layouts.app')

@section('title', 'Edit ' . $livestock->tag_number)

@section('content')
    @php($currentUser = auth()->user())

    {{-- Breadcrumb --}}
    <nav class="mb-6 flex items-center gap-2 text-sm text-slate-500">
        <a href="{{ route('livestock.index') }}" class="transition hover:text-green-700">Livestock</a>
        <span>/</span>
        <a href="{{ route('livestock.show', $livestock->id) }}" class="transition hover:text-green-700">{{ $livestock->tag_number }}</a>
        <span>/</span>
        <span class="font-medium text-slate-800">Edit</span>
    </nav>

    {{-- Page Header --}}
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">✏️ Edit Livestock</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">
            Update {{ $livestock->tag_number }}
        </h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
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
    <form method="POST" action="{{ route('livestock.update', $livestock->id) }}" class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Type --}}
            <div>
                <label for="edit-type" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Livestock Type <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="edit-type"
                    name="type"
                    value="{{ old('type', $livestock->type) }}"
                    required
                    placeholder="e.g. Cow, Goat, Sheep"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Breed --}}
            <div>
                <label for="edit-breed" class="mb-1.5 block text-sm font-medium text-slate-700">Breed</label>
                <input
                    type="text"
                    id="edit-breed"
                    name="breed"
                    value="{{ old('breed', $livestock->breed) }}"
                    placeholder="e.g. Holstein, Boer"
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('breed')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
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
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
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
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    @foreach (['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'] as $status)
                        <option value="{{ $status }}" @selected(old('health_status', $livestock->health_status) === $status)>
                            @php
                                $statusEmoji = match ($status) {
                                    'Healthy' => '✅',
                                    'Sick' => '🤒',
                                    'Under Treatment' => '💊',
                                    'Hospitalized' => '🏥',
                                    'Injured' => '🩹',
                                };
                            @endphp
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
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm font-mono text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
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
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
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
                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                @error('date_added')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Owner Info (Read-only) --}}
        @if ($livestock->owner)
            <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50/50 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-500 mb-3">Owner (cannot be changed here)</p>
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-100 text-sm font-bold text-green-700">
                        {{ strtoupper(substr($livestock->owner->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">{{ $livestock->owner->name }}</p>
                        <p class="text-xs text-slate-500">{{ $livestock->owner->owner_code }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Actions --}}
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-between">
            <a
                href="{{ route('livestock.show', $livestock->id) }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
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
