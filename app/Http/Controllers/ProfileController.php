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
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
    public function complete(Request $request): View
    {
        return view('profile.complete');
    }

    /**
     * Store required owner profile fields.
     */
    public function storeComplete(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
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
            ]);
        } else {
            $owner->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'name' => $user->name,
            ]);
        }

        return Redirect::route('owner.dashboard');
    }
}
