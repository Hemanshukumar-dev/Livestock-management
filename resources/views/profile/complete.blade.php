@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-12">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-4">Complete Your Profile</h1>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.complete.store') }}">
            @csrf

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input id="phone" name="phone" value="{{ old('phone') }}" required maxlength="20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea id="address" name="address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('address') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Complete Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
