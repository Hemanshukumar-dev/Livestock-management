<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\Owner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LivestockController extends Controller
{
    /**
     * Display a listing of all livestock with search & filters.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $query = Livestock::with(['owner', 'histories']);

        // Owners can only see their own livestock
        if ($user && $user->isOwner()) {
            $query->whereHas('owner', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Filter: search by tag number
        if ($request->filled('tag_number')) {
            $query->where('tag_number', 'like', '%' . $request->query('tag_number') . '%');
        }

        // Filter: owner name
        if ($request->filled('owner_name')) {
            $query->whereHas('owner', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->query('owner_name') . '%');
            });
        }

        // Filter: owner code
        if ($request->filled('owner_code')) {
            $query->whereHas('owner', function ($q) use ($request) {
                $q->where('owner_code', 'like', '%' . $request->query('owner_code') . '%');
            });
        }

        // Filter: livestock type
        if ($request->filled('type')) {
            $query->where('type', $request->query('type'));
        }

        // Filter: breed
        if ($request->filled('breed')) {
            $query->where('breed', $request->query('breed'));
        }

        // Filter: health status
        if ($request->filled('health_status')) {
            $query->where('health_status', $request->query('health_status'));
        }

        $livestock = $query->latest()->paginate(20)->withQueryString();

        // Populate filter dropdowns
        $livestockTypes = array_keys(config('livestock.types', []));
        $breeds = Livestock::select('breed')->whereNotNull('breed')->where('breed', '!=', '')->distinct()->orderBy('breed')->pluck('breed');
        $healthStatuses = ['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'];

        return view('livestock.index', compact(
            'livestock',
            'livestockTypes',
            'breeds',
            'healthStatuses'
        ));
    }

    /**
     * Show the form for creating a new livestock.
     */
    public function create(Request $request): View
    {
        $user = $request->user();
        $owners = [];

        if ($user && $user->isAdmin()) {
            $owners = Owner::orderBy('name')->get();
        }

        $livestockTypes = config('livestock.types', []);
        $healthStatuses = ['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'];

        return view('livestock.create', compact('owners', 'livestockTypes', 'healthStatuses', 'user'));
    }

    /**
     * Store a newly created livestock in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        $rules = [
            'type' => ['required', 'string', 'max:255'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'health_status' => ['required', 'string', 'in:Healthy,Sick,Under Treatment,Hospitalized,Injured'],
            'tag_number' => ['required', 'string', 'max:255', 'unique:livestock,tag_number'],
            'source' => ['required', 'string', 'in:Born,Purchased'],
            'date_added' => ['nullable', 'date'],
        ];

        if ($user && $user->isAdmin()) {
            $rules['owner_id'] = ['required', 'exists:owners,id'];
        }

        $validated = $request->validate($rules);

        if ($user && $user->isOwner()) {
            $owner = Owner::where('user_id', $user->id)->first();
            if (!$owner) {
                return back()->withErrors(['error' => 'You do not have an owner profile linked. Please contact admin.']);
            }
            $validated['owner_id'] = $owner->id;
        }

        $livestock = Livestock::create($validated);

        return redirect()
            ->route('livestock.show', $livestock->id)
            ->with('success', 'Livestock record added successfully.');
    }

    /**
     * Display a single livestock profile with full details, owner info, and history timeline.
     */
    public function show(Request $request, int $id): View
    {
        $livestock = Livestock::with([
            'owner',
            'histories' => function ($q) {
                $q->orderByDesc('event_date')->orderByDesc('id');
            },
        ])->findOrFail($id);

        $user = $request->user();

        // Owners can only view their own livestock
        if ($user && $user->isOwner()) {
            if ($livestock->owner?->user_id !== $user->id) {
                abort(403);
            }
        }

        return view('livestock.show', compact('livestock'));
    }

    /**
     * Show the edit form for a single livestock record.
     */
    public function edit(Request $request, int $id): View
    {
        $livestock = Livestock::with('owner')->findOrFail($id);

        $user = $request->user();

        // Owners can only edit their own livestock
        if ($user && $user->isOwner()) {
            if ($livestock->owner?->user_id !== $user->id) {
                abort(403);
            }
        }

        $livestockTypes = config('livestock.types', []);
        $healthStatuses = ['Healthy', 'Sick', 'Under Treatment', 'Hospitalized', 'Injured'];

        return view('livestock.edit', compact('livestock', 'livestockTypes', 'healthStatuses'));
    }

    /**
     * Update a single livestock record (does NOT recreate all livestock).
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $livestock = Livestock::with('owner')->findOrFail($id);

        $user = $request->user();

        // Owners can only update their own livestock
        if ($user && $user->isOwner()) {
            if ($livestock->owner?->user_id !== $user->id) {
                abort(403);
            }
        }

        $validated = $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'breed' => ['nullable', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'health_status' => ['required', 'string', 'in:Healthy,Sick,Under Treatment,Hospitalized,Injured'],
            'tag_number' => ['required', 'string', 'max:255', 'unique:livestock,tag_number,' . $livestock->id],
            'source' => ['required', 'string', 'in:Born,Purchased'],
            'date_added' => ['nullable', 'date'],
        ]);

        $livestock->update($validated);

        return redirect()
            ->route('livestock.show', $livestock->id)
            ->with('success', 'Livestock record updated successfully.');
    }

    /**
     * Delete a single livestock record (admin only).
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $livestock = Livestock::findOrFail($id);

        $user = $request->user();

        // Only admins can delete livestock
        if (! $user || ! $user->isAdmin()) {
            abort(403);
        }

        // Delete related histories first
        $livestock->histories()->delete();
        $livestock->delete();

        return redirect()
            ->route('livestock.index')
            ->with('success', 'Livestock record deleted successfully.');
    }
}
