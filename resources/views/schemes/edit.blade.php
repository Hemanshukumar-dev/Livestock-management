@extends('layouts.app')

@section('title', 'Edit Scheme')

@section('content')
    <div class="mb-6 max-w-3xl">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Government Support</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Edit scheme</h2>
        <p class="mt-1 text-sm leading-6 text-slate-600">Update the details of the government scheme.</p>
    </div>

    <form method="POST" action="{{ route('schemes.update', $scheme) }}" class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        @csrf
        @method('PUT')
        
        <div class="grid gap-6 sm:grid-cols-2">
            
            <div class="sm:col-span-2">
                <label for="title" class="mb-1.5 block text-sm font-semibold text-slate-700">Scheme Title *</label>
                <input id="title" name="title" type="text" value="{{ old('title', $scheme->title) }}" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category" class="mb-1.5 block text-sm font-semibold text-slate-700">Category *</label>
                <select id="category" name="category" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">Select Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" @selected(old('category', $scheme->category) === $cat)>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="animal_type" class="mb-1.5 block text-sm font-semibold text-slate-700">Target Animal Type</label>
                <select id="animal_type" name="animal_type" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">All Animals (Generic)</option>
                    @foreach ($animalTypes as $type)
                        <option value="{{ $type }}" @selected(old('animal_type', $scheme->animal_type) === $type)>{{ $type }}</option>
                    @endforeach
                </select>
                @error('animal_type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="scheme_type" class="mb-1.5 block text-sm font-semibold text-slate-700">Government Level *</label>
                <select id="scheme_type" name="scheme_type" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="State" @selected(old('scheme_type', $scheme->scheme_type) === 'State')>State Level</option>
                    <option value="Central" @selected(old('scheme_type', $scheme->scheme_type) === 'Central')>Central Level</option>
                </select>
                @error('scheme_type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div id="state_name_container">
                <label for="state_name" class="mb-1.5 block text-sm font-semibold text-slate-700">State Name *</label>
                <select id="state_name" name="state_name" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}" @selected(old('state_name', $scheme->state_name) === $state)>{{ $state }}</option>
                    @endforeach
                </select>
                @error('state_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="deadline" class="mb-1.5 block text-sm font-semibold text-slate-700">Application Deadline</label>
                <input id="deadline" name="deadline" type="date" value="{{ old('deadline', $scheme->deadline?->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                @error('deadline') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="apply_link" class="mb-1.5 block text-sm font-semibold text-slate-700">Official Application Link</label>
                <input id="apply_link" name="apply_link" type="url" value="{{ old('apply_link', $scheme->apply_link) }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                @error('apply_link') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Brief Description *</label>
                <textarea id="description" name="description" rows="3" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">{{ old('description', $scheme->description) }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="benefits" class="mb-1.5 block text-sm font-semibold text-slate-700">Key Benefits *</label>
                <textarea id="benefits" name="benefits" rows="2" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">{{ old('benefits', $scheme->benefits) }}</textarea>
                @error('benefits') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="eligibility" class="mb-1.5 block text-sm font-semibold text-slate-700">Eligibility Criteria *</label>
                <textarea id="eligibility" name="eligibility" rows="2" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">{{ old('eligibility', $scheme->eligibility) }}</textarea>
                @error('eligibility') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('schemes.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-sky-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500">
                Update Scheme
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schemeTypeSelect = document.getElementById('scheme_type');
            const stateNameContainer = document.getElementById('state_name_container');
            
            function toggleState() {
                if (schemeTypeSelect.value === 'State') {
                    stateNameContainer.style.display = 'block';
                } else {
                    stateNameContainer.style.display = 'none';
                }
            }
            
            schemeTypeSelect.addEventListener('change', toggleState);
            toggleState();
        });
    </script>
@endsection
