<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Owner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $owner = $user->isOwner() ? $user->owner : null;

        return view('profile.edit', [
            'user' => $user,
            'owner' => $owner,
        ]);
    }

    /**
     * Update the user's profile information.
     * Also syncs owner table fields (phone, address) for owner users.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Sync owner fields if the user is an owner
        if ($user->isOwner() && $user->owner) {
            $request->validate([
                'phone' => ['nullable', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:500'],
                'state' => ['nullable', 'string', 'max:255'],
            ]);

            $owner = $user->owner;
            $owner->name = $user->name;

            if ($request->filled('phone')) {
                $owner->phone = $request->input('phone');
            }
            if ($request->filled('address')) {
                $owner->address = $request->input('address');
            }
            if ($request->filled('state')) {
                $owner->state = $request->input('state');
            }

            $owner->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Show profile completion form for owners.
     */
    public function complete(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        // If profile is already complete, redirect to dashboard
        if ($user->isOwner()) {
            $owner = $user->owner;
            if ($owner && $owner->phone !== null && $owner->address !== null) {
                return redirect()->route('owner.dashboard');
            }
        }

        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return view('profile.complete');
    }

    /**
     * Store required owner profile fields.
     */
    public function storeComplete(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'state' => ['nullable', 'string', 'max:255'],
        ]);

        $user = $request->user();

        $owner = $user->owner;

        if (! $owner) {
            $owner = Owner::create([
                'user_id' => $user->id,
                'owner_code' => \App\Http\Controllers\OwnerController::generateOwnerCode(),
                'name' => $user->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'state' => $request->state,
            ]);
        } else {
            $owner->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'name' => $user->name,
                'state' => $request->state,
            ]);
        }

        return Redirect::route('owner.dashboard')
            ->with('success', 'Profile completed successfully! Welcome to your dashboard.');
    }
}
