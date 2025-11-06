<?php

namespace App\Http\Controllers;

use App\Models\Qualifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QualificationsController extends Controller
{
    public function index()
    {
        $qualifications = Qualifications::orderBy('created_at', 'desc')->get();
        return view('admin.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        return view('admin.qualifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification' => 'required|string|max:255',
        ]);

        try {
            Qualifications::create([
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('admin.qualifications.index')->with('success', 'Qualification created successfully!');
        } catch (\Throwable $e) {
            Log::error('Qualification store error: ' . $e->getMessage());
            return back()->withErrors('Failed to create qualification.');
        }
    }

    public function edit(Qualifications $qualification)
    {
        return view('admin.qualifications.edit', compact('qualification'));
    }

    public function update(Request $request, Qualifications $qualification)
    {
        $request->validate([
            'qualification' => 'required|string|max:255',
        ]);

        try {
            $qualification->update([
                'qualification' => $request->qualification,
            ]);

            return redirect()->route('admin.qualifications.index')->with('success', 'Qualification updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Qualification update error: ' . $e->getMessage());
            return back()->withErrors('Failed to update qualification.');
        }
    }

    public function destroy(Qualifications $qualification)
    {
        try {
            $qualification->delete();
            return redirect()->route('admin.qualifications.index')->with('success', 'Qualification deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Qualification delete error: ' . $e->getMessage());
            return back()->withErrors('Failed to delete qualification.');
        }
    }
}
