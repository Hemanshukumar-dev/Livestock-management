@extends('layouts.app')

@section('title', 'Edit Owner')

@section('content')
    @php
    $states = ['Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'];
    @endphp
    <div class="mb-6 max-w-3xl">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Update Record</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Edit owner details</h2>
        <p class="mt-1 text-sm leading-6 text-slate-600">Update the owner profile and manage their linked livestock records.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-12">
        <!-- Owner Details Form -->
        <div class="lg:col-span-4">
            <form method="POST" action="{{ route('owners.update', $owner->id) }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                @csrf
                @method('PUT')
                
                <div class="mb-5">
                    <h3 class="text-lg font-bold text-slate-900">Profile Information</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="owner_name" class="mb-1.5 block text-sm font-medium text-slate-700">Name</label>
                        <input id="owner_name" name="owner[name]" type="text" value="{{ old('owner.name', $owner->name) }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                        @error('owner.name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_phone" class="mb-1.5 block text-sm font-medium text-slate-700">Phone</label>
                        <input id="owner_phone" name="owner[phone]" type="text" value="{{ old('owner.phone', $owner->phone) }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                        @error('owner.phone')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_address" class="mb-1.5 block text-sm font-medium text-slate-700">Address</label>
                        <textarea id="owner_address" name="owner[address]" rows="3" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">{{ old('owner.address', $owner->address) }}</textarea>
                        @error('owner.address')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="owner_state" class="mb-1.5 block text-sm font-medium text-slate-700">State</label>
                        <select id="owner_state" name="owner[state]" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                            <option value="">Select state...</option>
                            @foreach ($states as $st)
                                <option value="{{ $st }}" @selected(old('owner.state', $owner->state) === $st)>{{ $st }}</option>
                            @endforeach
                        </select>
                        @error('owner.state')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    <a href="{{ route('owners.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Livestock Management -->
        <div class="lg:col-span-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Registered Livestock</h3>
                        <p class="mt-1 text-sm text-slate-500">Manage individual animals belonging to this owner.</p>
                    </div>
                    <a href="{{ route('livestock.create', ['owner_id' => $owner->id]) }}" class="inline-flex shrink-0 items-center justify-center rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500">
                        Add Livestock
                    </a>
                </div>

                @if ($livestockList->isEmpty())
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">
                        <p class="text-sm text-slate-500">No livestock registered for this owner yet.</p>
                    </div>
                @else
                    <div class="max-h-[400px] overflow-y-auto rounded-xl border border-slate-200 bg-slate-50 divide-y divide-slate-200">
                        @foreach ($livestockList as $animal)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 transition hover:bg-slate-100/50">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-sky-100 text-sky-700 text-lg">
                                        {{ (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type)) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-sm font-semibold text-slate-900">{{ $animal->type }}</h4>
                                            <span class="text-xs font-mono text-slate-500">{{ $animal->tag_number }}</span>
                                            @php
                                                $healthDot = match ($animal->health_status) {
                                                    'Healthy' => 'bg-emerald-500',
                                                    'Sick' => 'bg-red-500',
                                                    'Under Treatment' => 'bg-yellow-500',
                                                    'Hospitalized' => 'bg-slate-500',
                                                    'Injured' => 'bg-amber-500',
                                                    default => 'bg-slate-300',
                                                };
                                            @endphp
                                            <span class="flex items-center gap-1 text-[10px] font-semibold uppercase tracking-wider text-slate-600 ml-1">
                                                <span class="h-2 w-2 rounded-full {{ $healthDot }}"></span> {{ $animal->health_status }}
                                            </span>
                                        </div>
                                        <div class="mt-0.5 text-xs text-slate-500">
                                            {{ $animal->breed ?? 'Unknown Breed' }} • {{ $animal->age ?? '?' }} yrs
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 flex gap-2 sm:mt-0">
                                    <a href="{{ route('livestock.show', $animal->id) }}" class="inline-flex h-8 items-center justify-center rounded-lg bg-white border border-slate-200 px-3 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">View</a>
                                    <a href="{{ route('livestock.edit', $animal->id) }}" class="inline-flex h-8 items-center justify-center rounded-lg bg-slate-900 px-3 text-xs font-semibold text-white transition hover:bg-slate-700">Edit</a>
                                    <form method="POST" action="{{ route('livestock.destroy', $animal->id) }}" onsubmit="return confirm('Delete this livestock?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex h-8 items-center justify-center rounded-lg border border-red-200 bg-red-50 px-3 text-xs font-semibold text-red-700 transition hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection