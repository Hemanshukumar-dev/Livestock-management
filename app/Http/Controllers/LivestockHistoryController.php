<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivestockHistoryController extends Controller
{
    public function store(Request $request, int $livestockId): RedirectResponse
    {
        $validated = $request->validate([
            'event_type' => ['required', 'string', 'in:Vaccination,Treatment,Checkup,Illness,Deworming,Surgery'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        $livestock = Livestock::with('owner')->findOrFail($livestockId);

        $currentUser = $request->user();
        if ($currentUser?->isOwner() && $livestock->owner?->user_id !== $currentUser->id) {
            abort(403);
        }

        DB::transaction(function () use ($livestock, $validated) {
            $livestock->histories()->create([
                'event_type' => $validated['event_type'],
                'description' => $validated['description'] ?? null,
                'event_date' => $validated['event_date'],
            ]);
        });

        return redirect()->back()->with('success', 'History record saved.');
    }
}
