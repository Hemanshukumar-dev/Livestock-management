@extends('layouts.app')

@section('title', 'Complete Your Profile')

@section('content')
<div class="max-w-lg mx-auto mt-8">
    @php
    $states = ['Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'];
    @endphp

    {{-- Welcome Card --}}
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-3xl mb-4">
                👋
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Complete Your Profile</h1>
            <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                Welcome, <strong class="text-slate-800">{{ auth()->user()->name }}</strong>!
                We just need a couple more details to set up your account.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                <p class="font-semibold mb-1">⚠️ Please fix the following:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('profile.complete.store') }}" class="space-y-5">
            @csrf

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700">
                    📞 Phone Number <span class="text-red-500">*</span>
                </label>
                <input
                    id="phone"
                    type="tel"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                    maxlength="20"
                    autocomplete="tel"
                    placeholder="e.g. +91 98765 43210"
                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                />
                <p class="mt-1 text-xs text-slate-400">Your contact number for farm-related communication</p>
            </div>

            {{-- Address --}}
            <div>
                <label for="address" class="block text-sm font-medium text-slate-700">
                    📍 Farm / Home Address <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="address"
                    name="address"
                    required
                    rows="3"
                    maxlength="500"
                    autocomplete="street-address"
                    placeholder="e.g. Village Rampur, Block Sadar, District Varanasi, UP 221001"
                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20 resize-none"
                >{{ old('address') }}</textarea>
                <p class="mt-1 text-xs text-slate-400">Your farm or home address for record keeping</p>
            </div>
            {{-- State --}}
            <div>
                <label for="state" class="block text-sm font-medium text-slate-700">
                    🌍 State <span class="text-slate-400 font-normal">(Optional)</span>
                </label>
                <select
                    id="state"
                    name="state"
                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                >
                    <option value="">Select your state...</option>
                    @foreach ($states as $st)
                        <option value="{{ $st }}" @selected(old('state') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-slate-400">Add state to receive personalized government scheme recommendations</p>
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                class="w-full rounded-xl bg-green-700 px-4 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
            >
                ✅ Complete Profile & Continue
            </button>
        </form>
    </div>

    {{-- Info note --}}
    <p class="mt-4 text-center text-xs text-slate-400">
        You can update these details later from your profile settings.
    </p>
</div>
@endsection
