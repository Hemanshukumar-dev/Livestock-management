@extends('layouts.app')

@section('title', 'Edit History Event')

@section('content')
    <nav class="mb-6 flex items-center gap-2 text-sm text-txt-200">
        <a href="{{ route('livestock.index') }}" class="transition hover:text-green-700">Livestock</a>
        <span>/</span>
        <a href="{{ route('livestock.show', $history->livestock_id) }}" class="transition hover:text-green-700">{{ $history->livestock->tag_number }}</a>
        <span>/</span>
        <span class="font-medium text-txt-100">Edit History</span>
    </nav>

    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">✏️ Edit History</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-txt-100">
            Update Event for {{ $history->livestock->tag_number }}
        </h2>
    </div>

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

    <form method="POST" action="{{ route('livestock.histories.update', $history->id) }}" class="rounded-3xl border border-bg-300 bg-bg-100 p-8 shadow-sm max-w-2xl">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Event Type <span class="text-red-500">*</span>
                </label>
                <select name="event_type" required class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20">
                    <option value="">Select type</option>
                    @foreach(['Vaccination', 'Treatment', 'Checkup', 'Illness', 'Deworming', 'Surgery'] as $type)
                        <option value="{{ $type }}" @selected(old('event_type', $history->event_type) === $type)>
                            <?php
                                $emojis = [
                                    'Vaccination' => '💉',
                                    'Treatment' => '💊',
                                    'Checkup' => '🩺',
                                    'Illness' => '🤒',
                                    'Deworming' => '🧪',
                                    'Surgery' => '🔬',
                                ];
                                $emoji = $emojis[$type] ?? '📝';
                            ?>
                            {{ $emoji }} {{ $type }}
                        </option>
                    @endforeach
                </select>
                @error('event_type')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Event Date <span class="text-red-500">*</span>
                </label>
                <input type="date" name="event_date" required value="{{ old('event_date', $history->event_date ? \Illuminate\Support\Carbon::parse($history->event_date)->format('Y-m-d') : '') }}" class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20">
                @error('event_date')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Description
                </label>
                <textarea name="description" rows="4" class="w-full rounded-lg border border-bg-300 bg-bg-100 px-4 py-3 text-sm text-txt-100 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20" placeholder="Optional details...">{{ old('description', $history->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-between">
            <a href="{{ route('livestock.show', $history->livestock_id) }}" class="inline-flex items-center justify-center rounded-xl border border-bg-300 bg-bg-100 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-bg-200">
                ← Cancel
            </a>
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-green-700 px-8 py-3 text-sm font-semibold text-white transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50">
                💾 Save Changes
            </button>
        </div>
    </form>
@endsection
