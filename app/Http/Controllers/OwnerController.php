<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OwnerController extends Controller
{
    public static function generateOwnerCode(): string
    {
        $last = Owner::orderBy('id', 'desc')->first();
        $nextNumber = $last && preg_match('/^OWN(\d+)$/', $last->owner_code, $matches) ? (int) $matches[1] + 1 : 1;

        return 'OWN' . str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $type = $request->query('type');
        $currentUser = $request->user();

        $query = Owner::with([
            'user',
            'livestock' => function ($livestockQuery) {
                $livestockQuery->with([
                    'histories' => function ($historyQuery) {
                        $historyQuery->orderByDesc('event_date')->orderByDesc('id');
                    },
                ]);
            },
        ]);

        if ($currentUser && $currentUser->isOwner()) {
            $query->where('user_id', $currentUser->id);
        }

        // Filter by owner name
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Filter by livestock type
        if ($type) {
            $query->whereHas('livestock', function ($subquery) use ($type) {
                $subquery->where('type', $type);
            });
        }

        $owners = $query->latest()->get();
        $livestockTypes = \App\Models\Livestock::select('type')->distinct()->orderBy('type')->pluck('type');

        return view('owners.index', compact('owners', 'search', 'type', 'livestockTypes'));
    }

    public function create(): View
    {
        return view('owners.create');
    }

    public function edit(int $id): View
    {
        $owner = Owner::with('livestock')->findOrFail($id);
        if (auth()->user()->isOwner() && $owner->user_id !== auth()->id()) {
            abort(403);
        }
        $livestockList = $owner->livestock;

        return view('owners.edit', compact('owner', 'livestockList'));
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = array_merge($this->ownerValidationRules(), $this->livestockValidationRules());
        $validated = $request->validate($rules);
        $passwordPlain = Str::random(10);
        $credentials = null;

        DB::transaction(function () use ($validated, $passwordPlain, &$credentials): void {
            $ownerData = $validated['owner'];

            $ownerData['owner_code'] = self::generateOwnerCode();

            $user = User::create([
                'name' => $ownerData['name'],
                'email' => strtolower($ownerData['owner_code']) . '@livestock.local',
                'password' => Hash::make($passwordPlain),
                'role' => 'owner',
            ]);

            $ownerData['user_id'] = $user->id;

            $owner = Owner::create($ownerData);

            foreach ($validated['livestock'] as $animal) {
                $owner->livestock()->create([
                    'type' => $animal['type'],
                    'breed' => $animal['breed'] ?? null,
                    'age' => $animal['age'] ?? null,
                    'health_status' => $animal['health_status'] ?? 'Healthy',
                    'tag_number' => $animal['tag_number'],
                    'source' => $animal['source'] ?? 'Born',
                    'date_added' => $animal['date_added'] ?? null,
                ]);
            }

            $credentials = [
                'email' => $user->email,
                'password' => $passwordPlain,
            ];
        });

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner created successfully.')
            ->with('credentials', $credentials);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate($this->ownerValidationRules());

        DB::transaction(function () use ($validated, $id): void {
            $owner = Owner::findOrFail($id);
            if (auth()->user()->isOwner() && $owner->user_id !== auth()->id()) {
                abort(403);
            }
            $owner->update($validated['owner']);

            if ($owner->user) {
                $owner->user->update([
                    'name' => $validated['owner']['name'],
                ]);
            }
        });

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner details updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $owner = Owner::findOrFail($id);
        if (auth()->user()->isOwner() && $owner->user_id !== auth()->id()) {
            abort(403);
        }

        if ($owner->user) {
            $owner->user->delete();
        }

        $owner->delete();

        return redirect()
            ->route('owners.index')
            ->with('success', 'Owner deleted successfully.');
    }

    private function ownerValidationRules(): array
    {
        return [
            'owner.name' => ['required', 'string', 'max:255'],
            'owner.phone' => ['required', 'string', 'max:255'],
            'owner.address' => ['required', 'string'],
            'owner.state' => ['nullable', 'string'],
        ];
    }

    private function livestockValidationRules(): array
    {
        return [
            'livestock' => ['required', 'array', 'min:1'],
            'livestock.*.type' => ['required', 'string', 'max:255'],
            'livestock.*.breed' => ['nullable', 'string', 'max:255'],
            'livestock.*.age' => ['required', 'integer', 'min:0'],
            'livestock.*.health_status' => ['required', 'string', 'in:Healthy,Sick,Under Treatment,Hospitalized,Injured'],
            'livestock.*.tag_number' => ['required', 'string', 'max:255', 'distinct', 'unique:livestock,tag_number'],
            'livestock.*.source' => ['required', 'string', 'in:Born,Purchased'],
            'livestock.*.date_added' => ['nullable', 'date'],
        ];
    }
}