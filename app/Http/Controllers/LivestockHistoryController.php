<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\LivestockHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

    private function authorizeHistoryAccess(LivestockHistory $history)
    {
        $currentUser = request()->user();
        $history->loadMissing('livestock.owner');
        if ($currentUser?->isOwner() && $history->livestock->owner?->user_id !== $currentUser->id) {
            abort(403);
        }
    }

    public function edit(int $historyId): View
    {
        $history = LivestockHistory::with('livestock')->findOrFail($historyId);
        $this->authorizeHistoryAccess($history);

        return view('livestock.histories.edit', compact('history'));
    }

    public function update(Request $request, int $historyId): RedirectResponse
    {
        $history = LivestockHistory::findOrFail($historyId);
        $this->authorizeHistoryAccess($history);

        $validated = $request->validate([
            'event_type' => ['required', 'string', 'in:Vaccination,Treatment,Checkup,Illness,Deworming,Surgery'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
        ]);

        $history->update([
            'event_type' => $validated['event_type'],
            'description' => $validated['description'] ?? null,
            'event_date' => $validated['event_date'],
        ]);

        return redirect()->route('livestock.show', $history->livestock_id)->with('success', 'History record updated.');
    }

    public function destroy(int $historyId): RedirectResponse
    {
        $history = LivestockHistory::findOrFail($historyId);
        $this->authorizeHistoryAccess($history);

        $history->delete();

        return back()->with('success', 'History record deleted.');
    }
}
