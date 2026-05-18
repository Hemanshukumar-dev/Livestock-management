<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function index(Request $request)
    {
        $query = Scheme::query();

        $user = $request->user();
        $isOwner = $user && $user->isOwner();
        $ownerState = null;

        if ($isOwner) {
            $ownerState = $user->owner->state ?? null;
            if ($ownerState) {
                $query->where(function($q) use ($ownerState) {
                    $q->where('scheme_type', 'Central')
                      ->orWhere(function($sq) use ($ownerState) {
                          $sq->where('scheme_type', 'State')
                             ->where('state_name', $ownerState);
                      });
                });
            } else {
                $query->where('scheme_type', 'Central');
            }
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('animal_type')) {
            $query->where('animal_type', $request->animal_type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('scheme_type')) {
            if ($isOwner) {
                if ($request->scheme_type === 'Central') {
                    $query->where('scheme_type', 'Central');
                } elseif ($request->scheme_type === 'My State Schemes' && $ownerState) {
                    $query->where('scheme_type', 'State')->where('state_name', $ownerState);
                }
            } else {
                $query->where('scheme_type', $request->scheme_type);
            }
        }

        $schemes = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        $animalTypes = ['Cow', 'Buffalo', 'Goat', 'Sheep', 'Poultry', 'Pig'];
        $categories = [
            'Dairy', 'Poultry', 'Goat Farming', 'Sheep Farming', 'Fisheries', 'Pig Farming', 
            'Cattle Welfare', 'Insurance', 'Subsidy', 'Loan Assistance', 'Animal Healthcare', 
            'Rural Development', 'Organic Farming', 'General Livestock'
        ];

        return view('schemes.index', compact('schemes', 'animalTypes', 'categories', 'isOwner', 'ownerState'));
    }

    public function create()
    {
        $animalTypes = ['Cow', 'Buffalo', 'Goat', 'Sheep', 'Poultry', 'Pig'];
        $categories = [
            'Dairy', 'Poultry', 'Goat Farming', 'Sheep Farming', 'Fisheries', 'Pig Farming', 
            'Cattle Welfare', 'Insurance', 'Subsidy', 'Loan Assistance', 'Animal Healthcare', 
            'Rural Development', 'Organic Farming', 'General Livestock'
        ];
        $states = [
            'Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 
            'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 
            'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 
            'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'
        ];
        return view('schemes.create', compact('animalTypes', 'categories', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'animal_type' => 'nullable|string|max:255',
            'scheme_type' => 'required|in:State,Central',
            'state_name' => 'nullable|required_if:scheme_type,State|string|max:255',
            'eligibility' => 'required|string',
            'benefits' => 'required|string',
            'deadline' => 'nullable|date',
            'apply_link' => 'nullable|url',
            'description' => 'required|string',
        ]);

        Scheme::create($validated);

        return redirect()->route('schemes.index')->with('success', 'Scheme created successfully.');
    }

    public function show(Scheme $scheme)
    {
        return view('schemes.show', compact('scheme'));
    }

    public function edit(Scheme $scheme)
    {
        $animalTypes = ['Cow', 'Buffalo', 'Goat', 'Sheep', 'Poultry', 'Pig'];
        $categories = [
            'Dairy', 'Poultry', 'Goat Farming', 'Sheep Farming', 'Fisheries', 'Pig Farming', 
            'Cattle Welfare', 'Insurance', 'Subsidy', 'Loan Assistance', 'Animal Healthcare', 
            'Rural Development', 'Organic Farming', 'General Livestock'
        ];
        $states = [
            'Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 
            'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 
            'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 
            'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'
        ];
        return view('schemes.edit', compact('scheme', 'animalTypes', 'categories', 'states'));
    }

    public function update(Request $request, Scheme $scheme)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'animal_type' => 'nullable|string|max:255',
            'scheme_type' => 'required|in:State,Central',
            'state_name' => 'nullable|required_if:scheme_type,State|string|max:255',
            'eligibility' => 'required|string',
            'benefits' => 'required|string',
            'deadline' => 'nullable|date',
            'apply_link' => 'nullable|url',
            'description' => 'required|string',
        ]);

        $scheme->update($validated);

        return redirect()->route('schemes.index')->with('success', 'Scheme updated successfully.');
    }

    public function destroy(Scheme $scheme)
    {
        $scheme->delete();
        return redirect()->route('schemes.index')->with('success', 'Scheme deleted successfully.');
    }
}
