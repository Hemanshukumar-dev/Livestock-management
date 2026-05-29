<x-auth-split-layout>
    {{-- Image Section (Left on Desktop) --}}
    <div class="hidden lg:block lg:w-1/2 relative p-3 order-1" style="view-transition-name: image-panel;">
        <div class="absolute inset-3 rounded-[20px] overflow-hidden group">
            <div class="absolute inset-0 bg-bg-100/20 z-10 transition duration-700 group-hover:bg-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-bg-100/90 via-bg-100/30 to-transparent z-10"></div>
            
            <img src="{{ asset('images/cow.png') }}" alt="Cow" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105" />
            
            <div class="absolute bottom-12 left-10 z-20 pr-10">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-bg-300/10 backdrop-blur-md border border-agri-surface/20 mb-4 shadow-cinematic">
                    <span class="w-2 h-2 rounded-full bg-primary-300 animate-pulse"></span>
                    <span class="text-xs font-semibold text-white tracking-widest uppercase">Cattle Management</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-3 tracking-tight">Grow your herd.</h3>
                <p class="text-txt-200 max-w-sm text-base leading-relaxed">Join thousands of modern farmers tracking health, breeding, and production effortlessly.</p>
            </div>
        </div>
    </div>

    {{-- Form Section (Right on Desktop) --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-10 sm:px-12 lg:px-16 xl:px-24 order-2" style="view-transition-name: auth-panel;">
        @php
        $states = ['Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'];
        @endphp

        <div class="mb-8">
            <a href="/" class="inline-flex items-center gap-2 group mb-6 lg:hidden">
                <span class="text-3xl transition duration-300 group-hover:scale-110">🐄</span>
                <span class="text-xl font-bold text-txt-100 tracking-tight">Livestock System</span>
            </a>
            <h2 class="text-3xl font-bold text-txt-100 tracking-tight">Create Your Account</h2>
            <p class="mt-2 text-sm text-txt-200">Join to start managing your livestock records</p>
        </div>

        {{-- Google OAuth Button --}}
        <a href="{{ route('google.login') }}" class="flex w-full items-center justify-center gap-3 rounded-xl border border-bg-300 bg-bg-300 px-4 py-3 text-sm font-semibold text-txt-100 shadow-cinematic transition-all duration-300 hover:hover:bg-primary-100/20 hover:border-primary-300/50 hover:shadow-cinematic-hover hover:-translate-y-0.5">
            <svg class="h-5 w-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Sign up with Google
        </a>

        {{-- Divider --}}
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-bg-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-bg-300 px-4 text-txt-200 font-medium transition-colors">or register with email</span>
            </div>
        </div>

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div class="group">
                <label for="name" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Full Name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Your full name"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-status-danger" />
            </div>

            <!-- Email Address -->
            <div class="group">
                <label for="email" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="you@example.com"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-status-danger" />
            </div>

            <!-- Password -->
            <div class="group">
                <label for="password" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-status-danger" />
            </div>

            <!-- Confirm Password -->
            <div class="group">
                <label for="password_confirmation" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Confirm Password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-status-danger" />
            </div>

            <!-- State -->
            <div class="group">
                <label for="state" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">State</label>
                <select
                    id="state"
                    name="state"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50 appearance-none bg-[url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2224%22%20height%3D%2224%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20stroke%3D%22%237d8b83%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%2F%3E%3C%2Fsvg%3E')] bg-[length:20px] bg-[position:right_1rem_center] bg-no-repeat pr-10"
                >
                    <option value="" disabled selected class="hover:bg-primary-100/20 text-txt-200">Select your state...</option>
                    @foreach ($states as $state)
                        <option value="{{ $state }}" @selected(old('state') === $state) class="hover:bg-primary-100/20">{{ $state }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('state')" class="mt-1.5 text-status-danger" />
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="mt-4 w-full rounded-xl bg-primary-200 px-4 py-3.5 text-sm font-semibold text-white shadow-cinematic transition-all duration-300 hover:bg-primary-100 hover:shadow-cinematic-hover hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-agri-cta/50 border border-primary-100"
            >
                Create Account
            </button>
        </form>

        {{-- Login Link --}}
        <p class="mt-6 text-center text-sm text-txt-200">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-primary-300 transition-colors hover:text-primary-100 ml-1">
                Sign in
            </a>
        </p>
    </div>
</x-auth-split-layout>
