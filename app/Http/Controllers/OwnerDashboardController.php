<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\LivestockHistory;

class OwnerDashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $owner = auth()->user()?->owner;

        // If owner record missing or profile incomplete, force completion
        if (! $owner || $owner->phone === null || $owner->address === null) {
            return redirect()->route('profile.complete');
        }

        $totalLivestock = $owner->livestock()->count();
        $totalHistory = LivestockHistory::whereHas('livestock', function ($q) use ($owner) {
            $q->where('owner_id', $owner->id);
        })->count();

        $latestLivestock = $owner->livestock()->latest()->take(5)->get();
        
        $attentionLivestock = $owner->livestock()
            ->whereIn('health_status', ['Sick', 'Under Treatment', 'Injured', 'Hospitalized'])
            ->latest()
            ->take(5)
            ->get();
            
        $recentHistory = LivestockHistory::with('livestock')
            ->whereHas('livestock', function ($q) use ($owner) {
                $q->where('owner_id', $owner->id);
            })
            ->orderByDesc('event_date')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $featuredSchemes = \App\Models\Scheme::latest()->take(3)->get();

        return view('dashboard.owner', compact(
            'owner', 
            'totalLivestock', 
            'totalHistory', 
            'latestLivestock', 
            'attentionLivestock', 
            'recentHistory',
            'featuredSchemes'
        ));
    }
}
