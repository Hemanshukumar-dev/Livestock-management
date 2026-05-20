<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\LivestockHistoryController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchemeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return view('welcome');
    }

    return redirect()->route(
        Auth::user()->isAdmin() ? 'dashboard' : 'owner.dashboard'
    );
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::middleware(['auth', 'role:admin'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'role:owner'])->get('/my-dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
// Profile completion routes (accessible to any authenticated user; controller handles role logic)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/complete', [ProfileController::class, 'complete'])->name('profile.complete');
    Route::post('/profile/complete', [ProfileController::class, 'storeComplete'])->name('profile.complete.store');
});
Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
    Route::post('/livestock/{id}/history', [LivestockHistoryController::class, 'store'])->name('livestock.histories.store');
    Route::get('/livestock/history/{history}/edit', [LivestockHistoryController::class, 'edit'])->name('livestock.histories.edit');
    Route::put('/livestock/history/{history}', [LivestockHistoryController::class, 'update'])->name('livestock.histories.update');
    Route::delete('/livestock/history/{history}', [LivestockHistoryController::class, 'destroy'])->name('livestock.histories.destroy');
});

// Livestock Management Module
Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/livestock', [LivestockController::class, 'index'])->name('livestock.index');
    Route::get('/livestock/create', [LivestockController::class, 'create'])->name('livestock.create');
    Route::post('/livestock', [LivestockController::class, 'store'])->name('livestock.store');
    Route::get('/livestock/{id}', [LivestockController::class, 'show'])->name('livestock.show');
    Route::get('/livestock/{id}/edit', [LivestockController::class, 'edit'])->name('livestock.edit');
    Route::put('/livestock/{id}', [LivestockController::class, 'update'])->name('livestock.update');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/livestock/{id}', [LivestockController::class, 'destroy'])->name('livestock.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/owners/create', [OwnerController::class, 'create'])->name('owners.create');
    Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
    Route::get('/owners/{id}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
    Route::put('/owners/{id}', [OwnerController::class, 'update'])->name('owners.update');
    Route::delete('/owners/{id}', [OwnerController::class, 'destroy'])->name('owners.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Government Schemes Module
Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/schemes', [SchemeController::class, 'index'])->name('schemes.index');
    Route::get('/schemes/{scheme}', [SchemeController::class, 'show'])->name('schemes.show');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/schemes/create', [SchemeController::class, 'create'])->name('schemes.create');
    Route::post('/admin/schemes', [SchemeController::class, 'store'])->name('schemes.store');
    Route::get('/admin/schemes/{scheme}/edit', [SchemeController::class, 'edit'])->name('schemes.edit');
    Route::put('/admin/schemes/{scheme}', [SchemeController::class, 'update'])->name('schemes.update');
    Route::delete('/admin/schemes/{scheme}', [SchemeController::class, 'destroy'])->name('schemes.destroy');
});

Route::get('/setup-admin', function () {
    $user = \App\Models\User::where('email', 'beast@admin.com')->first();
    
    // 5. Add temporary logging to confirm
    \Illuminate\Support\Facades\Log::info('--- /setup-admin started ---');

    if ($user) {
        $user->update([
            'password' => 'Admin123', // Removed Hash::make() to prevent double hashing
            'role' => 'admin',
        ]);
        \Illuminate\Support\Facades\Log::info('Admin user updated (user exists).');
    } else {
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'beast@admin.com',
            'password' => 'Admin123', // Removed Hash::make() to prevent double hashing
            'role' => 'admin',
        ]);
        \Illuminate\Support\Facades\Log::info('Admin user created.');
    }
    
    // Reload user to get fresh attributes
    $user->refresh();
    
    // Check if user exists
    \Illuminate\Support\Facades\Log::info('User exists: ' . ($user ? 'Yes' : 'No'));
    // Check if password hash exists
    \Illuminate\Support\Facades\Log::info('Password hash exists: ' . (!empty($user->password) ? 'Yes' : 'No'));
    \Illuminate\Support\Facades\Log::info('Current Hash in DB: ' . $user->password);
    
    // Check if Hash::check() passes
    $hashCheck = \Illuminate\Support\Facades\Hash::check('Admin123', $user->password);
    \Illuminate\Support\Facades\Log::info('Hash::check() passes: ' . ($hashCheck ? 'Yes' : 'No'));

    return "Admin account configured successfully. Hash check passed: " . ($hashCheck ? 'Yes' : 'No');
});

require __DIR__.'/auth.php';
