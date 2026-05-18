<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\Owner;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Total counts
        $totalOwners = Owner::count();
        $totalLivestock = Livestock::count();

        // Livestock by type
        $livestockByType = Livestock::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->orderByDesc('count')
            ->get();

        // Livestock by health status
        $livestockByStatus = Livestock::selectRaw('health_status, COUNT(*) as count')
            ->groupBy('health_status')
            ->orderByDesc('count')
            ->get();

        // Featured Schemes
        $featuredSchemes = \App\Models\Scheme::latest()->take(3)->get();

        return view('dashboard.index', compact(
            'totalOwners',
            'totalLivestock',
            'livestockByType',
            'livestockByStatus',
            'featuredSchemes'
        ));
    }
}
