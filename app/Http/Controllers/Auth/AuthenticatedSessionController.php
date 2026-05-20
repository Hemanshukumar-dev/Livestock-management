<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        \Illuminate\Support\Facades\Log::info('LoginRequest validation passed, attempting to authenticate...');
        $request->authenticate();
        \Illuminate\Support\Facades\Log::info('User authenticated successfully. ID: ' . $request->user()->id);

        $request->session()->regenerate();
        \Illuminate\Support\Facades\Log::info('Session regenerated. Session ID: ' . $request->session()->getId());

        $destination = $request->user()->isAdmin()
            ? route('dashboard', absolute: false)
            : route('owner.dashboard', absolute: false);

        \Illuminate\Support\Facades\Log::info('Redirecting user to: ' . $destination);
        return redirect()->intended($destination);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
