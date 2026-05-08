<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OwnerDashboardController extends Controller
{
    public function index(): View
    {
        $owner = auth()->user()?->owner;

        // If owner record missing or profile incomplete, force completion
        if (! $owner || $owner->phone === null || $owner->address === null) {
            return redirect()->route('profile.complete');
        }

        if ($owner) {
            $owner->load([
                'livestock' => function ($livestockQuery) {
                    $livestockQuery->with([
                        'histories' => function ($historyQuery) {
                            $historyQuery->orderByDesc('event_date')->orderByDesc('id');
                        },
                    ]);
                },
            ]);
        }

        return view('dashboard.owner', compact('owner'));
    }
}
