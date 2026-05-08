@extends('layouts.app')

@section('title', 'Livestock Management — Simple Record Keeping for Farmers')
@section('content_class', '')

@section('content')

{{-- ==============================
     HERO SECTION
     ============================== --}}
<div class="bg-[#f8faf5]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

      {{-- Left: Text Content --}}
      <div>
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-6">
          Simple Livestock Management for Everyday Use
        </h1>

        <p class="text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed">
          Keep track of your animals, their health, and ownership details without confusion. Designed for farmers and livestock keepers.
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
          <a href="{{ route('register') }}" id="hero-register-btn" class="inline-flex items-center justify-center px-8 py-3.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition text-lg">
            Create Account
          </a>
          <a href="{{ route('login') }}" id="hero-login-btn" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-gray-300 text-gray-800 font-semibold rounded-lg hover:border-green-500 hover:text-green-700 transition text-lg">
            Login
          </a>
        </div>

        {{-- Trust Line --}}
        <p class="text-sm text-gray-500 flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
          Used by small farms and growing livestock businesses
        </p>
      </div>

      {{-- Right: Illustration-Style Animal Blocks --}}
      <div class="flex justify-center lg:justify-end">
        <div class="grid grid-cols-2 gap-4 sm:gap-5 max-w-sm">
          {{-- Cow --}}
          <div class="bg-white border border-green-100 rounded-xl p-6 text-center hover:border-green-300 transition">
            <div class="text-5xl mb-3">🐄</div>
            <p class="text-sm font-medium text-gray-700">Cattle</p>
            <p class="text-xs text-gray-400 mt-1">Track Animals</p>
          </div>

          {{-- Goat --}}
          <div class="bg-white border border-green-100 rounded-xl p-6 text-center hover:border-green-300 transition">
            <div class="text-5xl mb-3">🐐</div>
            <p class="text-sm font-medium text-gray-700">Goats</p>
            <p class="text-xs text-gray-400 mt-1">Health Records</p>
          </div>

          {{-- Sheep --}}
          <div class="bg-white border border-green-100 rounded-xl p-6 text-center hover:border-green-300 transition">
            <div class="text-5xl mb-3">🐑</div>
            <p class="text-sm font-medium text-gray-700">Sheep</p>
            <p class="text-xs text-gray-400 mt-1">Owner Details</p>
          </div>

          {{-- All Animals --}}
          <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center">
            <div class="text-5xl mb-3">📋</div>
            <p class="text-sm font-medium text-green-700">All Records</p>
            <p class="text-xs text-green-500 mt-1">In One Place</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ==============================
     TRUST STRIP
     ============================== --}}
<div class="bg-white border-y border-gray-100 py-5">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-sm font-medium text-gray-500">
      Designed for farmers, veterinarians, and livestock keepers — simple enough for anyone to use
    </p>
  </div>
</div>

{{-- ==============================
     REAL LIFE BENEFITS SECTION
     ============================== --}}
<div class="bg-[#f8faf5] py-16 sm:py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        Why Farmers Prefer This System
      </h2>
      <p class="text-lg text-gray-500">
        Built around how farmers actually work — not how software companies think they should.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">

      {{-- Card 1 --}}
      <div id="benefit-paperwork" class="bg-white rounded-xl border border-gray-100 p-8 hover:border-green-200 transition">
        <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center mb-5">
          <span class="text-2xl">📝</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">No Paperwork Hassle</h3>
        <p class="text-gray-600 leading-relaxed">
          Stop managing records in notebooks. Everything is stored safely in one place.
        </p>
      </div>

      {{-- Card 2 --}}
      <div id="benefit-easy" class="bg-white rounded-xl border border-gray-100 p-8 hover:border-green-200 transition">
        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-5">
          <span class="text-2xl">👍</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Easy to Use</h3>
        <p class="text-gray-600 leading-relaxed">
          Simple design that anyone can understand, even without technical knowledge.
        </p>
      </div>

      {{-- Card 3 --}}
      <div id="benefit-health" class="bg-white rounded-xl border border-gray-100 p-8 hover:border-green-200 transition">
        <div class="w-12 h-12 bg-rose-50 rounded-lg flex items-center justify-center mb-5">
          <span class="text-2xl">❤️</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Track Animal Health</h3>
        <p class="text-gray-600 leading-relaxed">
          Know which animals are healthy, sick, or under treatment at a glance.
        </p>
      </div>
    </div>
  </div>
</div>

{{-- ==============================
     HOW IT WORKS SECTION
     ============================== --}}
<div class="bg-white py-16 sm:py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
      <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        How It Works
      </h2>
      <p class="text-lg text-gray-500">
        Get started in three simple steps
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">

      {{-- Step 1 --}}
      <div id="step-1" class="text-center relative">
        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
          <span class="text-xl font-bold text-green-700">1</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Create Your Account</h3>
        <p class="text-sm text-gray-500">Sign up with your name and email. It takes less than a minute.</p>

        {{-- Arrow (hidden on mobile) --}}
        <div class="hidden md:block absolute top-7 -right-4 w-8 text-green-300">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </div>

      {{-- Step 2 --}}
      <div id="step-2" class="text-center relative">
        <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-5">
          <span class="text-xl font-bold text-amber-700">2</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Add Your Livestock</h3>
        <p class="text-sm text-gray-500">Enter your animals — their type, breed, tag number, and health status.</p>

        {{-- Arrow (hidden on mobile) --}}
        <div class="hidden md:block absolute top-7 -right-4 w-8 text-green-300">
          <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </div>
      </div>

      {{-- Step 3 --}}
      <div id="step-3" class="text-center">
        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-5">
          <span class="text-xl font-bold text-green-700">3</span>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Track Health & Records</h3>
        <p class="text-sm text-gray-500">View and manage all your animals' health and ownership records easily.</p>
      </div>
    </div>
  </div>
</div>

{{-- ==============================
     REAL-LIFE SAMPLE RECORD
     ============================== --}}
<div class="bg-[#f8faf5] py-16 sm:py-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

      {{-- Left: Description --}}
      <div>
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
          See What a Record Looks Like
        </h2>
        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
          Every animal in your herd gets a simple, clear record. You can view health status, owner details, and tag information at a glance — no training needed.
        </p>
        <ul class="space-y-3">
          <li class="flex items-start gap-3">
            <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 rounded-full flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="text-gray-700">Each animal gets a unique tag number</span>
          </li>
          <li class="flex items-start gap-3">
            <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 rounded-full flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="text-gray-700">Health status is updated and easy to read</span>
          </li>
          <li class="flex items-start gap-3">
            <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 rounded-full flex-shrink-0 mt-0.5">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="text-gray-700">Owner details linked to each animal</span>
          </li>
        </ul>
      </div>

      {{-- Right: Example Record Card --}}
      <div class="flex justify-center lg:justify-end">
        <div id="example-record" class="bg-white rounded-xl border border-gray-200 p-6 sm:p-8 max-w-sm w-full">
          <div class="flex items-center gap-2 mb-6">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Example Record</span>
          </div>

          <div class="space-y-5">
            {{-- Animal --}}
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-3">
                <span class="text-3xl">🐄</span>
                <div>
                  <div class="text-base font-bold text-gray-900">Cow</div>
                  <div class="text-sm text-gray-400">Tag A102</div>
                </div>
              </div>
              <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full border border-green-200">
                Healthy
              </span>
            </div>

            <div class="border-t border-gray-100"></div>

            {{-- Owner --}}
            <div>
              <div class="text-xs text-gray-400 mb-1">Owner</div>
              <div class="text-sm font-medium text-gray-800">Ramesh Kumar</div>
            </div>

            {{-- Breed --}}
            <div>
              <div class="text-xs text-gray-400 mb-1">Breed</div>
              <div class="text-sm font-medium text-gray-800">Holstein Dairy</div>
            </div>

            {{-- Age --}}
            <div>
              <div class="text-xs text-gray-400 mb-1">Age</div>
              <div class="text-sm font-medium text-gray-800">3 years</div>
            </div>
          </div>

          <div class="mt-6 pt-5 border-t border-gray-100">
            <div class="text-xs text-gray-400">Last checked: 2 days ago</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ==============================
     FINAL CTA SECTION
     ============================== --}}
<div class="bg-green-700 py-16 sm:py-20">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
      Start Managing Your Livestock Today
    </h2>
    <p class="text-lg text-green-100 mb-10">
      Takes less than 2 minutes to get started
    </p>
    <a href="{{ route('register') }}" id="cta-register-btn" class="inline-flex items-center justify-center px-8 py-4 bg-white text-green-700 font-bold rounded-lg hover:bg-green-50 transition text-lg">
      Create Free Account
    </a>
  </div>
</div>

{{-- ==============================
     FOOTER
     ============================== --}}
<footer class="bg-gray-800 text-gray-400 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
      <p class="text-sm">© {{ date('Y') }} Livestock Management System. Made for farmers.</p>
    </div>
  </div>
</footer>

@endsection
