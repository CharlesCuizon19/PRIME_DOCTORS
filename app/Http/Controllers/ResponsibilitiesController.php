<?php

namespace App\Http\Controllers;

use App\Models\Responsibilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponsibilitiesController extends Controller
{
    public function index()
    {
        $responsibilities = Responsibilities::orderBy('created_at', 'desc')->get();
        return view('admin.responsibilities.index', compact('responsibilities'));
    }

    public function create()
    {
        return view('admin.responsibilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'responsibility' => 'required|string|max:255',
        ]);

        try {
            Responsibilities::create([
                'responsibility' => $request->responsibility,
            ]);

            return redirect()->route('admin.responsibilities.index')->with('success', 'Responsibility created successfully!');
        } catch (\Throwable $e) {
            Log::error('Responsibility store error: ' . $e->getMessage());
            return back()->withErrors('Failed to create responsibility.');
        }
    }

    public function edit(Responsibilities $responsibility)
    {
        return view('admin.responsibilities.edit', compact('responsibility'));
    }

    public function update(Request $request, Responsibilities $responsibility)
    {
        $request->validate([
            'responsibility' => 'required|string|max:255',
        ]);

        try {
            $responsibility->update([
                'responsibility' => $request->responsibility,
            ]);

            return redirect()->route('admin.responsibilities.index')->with('success', 'Responsibility updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Responsibility update error: ' . $e->getMessage());
            return back()->withErrors('Failed to update responsibility.');
        }
    }

    public function destroy(Responsibilities $responsibility)
    {
        try {
            $responsibility->delete();
            return redirect()->route('admin.responsibilities.index')->with('success', 'Responsibility deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Responsibility delete error: ' . $e->getMessage());
            return back()->withErrors('Failed to delete responsibility.');
        }
    }
}
