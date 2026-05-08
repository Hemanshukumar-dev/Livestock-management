<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            $user = DB::transaction(function () use ($googleUser): User {
                $user = User::create([
                    'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(20)),
                    'role' => 'owner',
                ]);

                $ownerCode = OwnerController::generateOwnerCode();

                Owner::create([
                    'user_id' => $user->id,
                    'owner_code' => $ownerCode,
                    'name' => $user->name,
                    'phone' => null,
                    'address' => null,
                ]);

                return $user;
            });
        } elseif ($user->isOwner() && ! $user->owner) {
            Owner::create([
                'user_id' => $user->id,
                'owner_code' => OwnerController::generateOwnerCode(),
                'name' => $user->name,
                'phone' => null,
                'address' => null,
            ]);
        }

        Auth::login($user);

        // Ensure owner exists and force profile completion if necessary
        if ($user->isAdmin()) {
            return redirect()->route('dashboard');
        }

        $owner = $user->owner;

        if (! $owner || $owner->phone === null || $owner->address === null) {
            return redirect()->route('profile.complete');
        }

        return redirect()->route('owner.dashboard');
    }
}