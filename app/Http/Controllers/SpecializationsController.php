<?php

namespace App\Http\Controllers;

use App\Models\Specializations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpecializationsController extends Controller
{
    /**
     * Display a listing of the specializations.
     */
    public function index()
    {
        $specializations = Specializations::orderBy('created_at', 'desc')->get();
        return view('admin.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new specialization.
     */
    public function create()
    {
        return view('admin.specializations.create');
    }

    /**
     * Store a newly created specialization in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'specialization_name' => 'required|string|max:255|unique:specializations,specialization_name',
        ]);

        try {
            Specializations::create([
                'specialization_name' => $request->specialization_name,
            ]);

            return redirect()
                ->route('admin.specialization.index')
                ->with('success', 'Specialization created successfully!');
        } catch (\Throwable $e) {
            Log::error('Specialization store error: ' . $e->getMessage());
            return back()->withErrors('Failed to create specialization.');
        }
    }

    /**
     * Show the form for editing the specified specialization.
     */
    public function edit(Specializations $specialization)
    {
        return view('admin.specializations.edit', compact('specialization'));
    }

    /**
     * Update the specified specialization in storage.
     */
    public function update(Request $request, Specializations $specialization)
    {
        $request->validate([
            'specialization_name' => 'required|string|max:255|unique:specializations,specialization_name,' . $specialization->id,
        ]);

        try {
            $specialization->update([
                'specialization_name' => $request->specialization_name,
            ]);

            return redirect()
                ->route('admin.specializations.index')
                ->with('success', 'Specialization updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Specialization update error: ' . $e->getMessage());
            return back()->withErrors('Failed to update specialization.');
        }
    }

    /**
     * Remove the specified specialization from storage.
     */
    public function destroy(Specializations $specialization)
    {
        try {
            $specialization->delete();
            return redirect()
                ->route('admin.specialization.index')
                ->with('success', 'Specialization deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Specialization delete error: ' . $e->getMessage());
            return back()->withErrors('Failed to delete specialization.');
        }
    }
}
