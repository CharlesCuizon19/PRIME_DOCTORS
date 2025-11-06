<?php

namespace App\Http\Controllers;

use App\Models\Inclusions;
use Illuminate\Http\Request;

class InclusionsController extends Controller
{
    /**
     * Display all inclusions.
     */
    public function index()
    {
        $inclusions = Inclusions::orderBy('created_at', 'desc')->get();
        return view('admin.inclusions.index', compact('inclusions'));
    }

    /**
     * Store a newly created inclusion.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'inclusion_name' => 'required|string|max:255',
        ]);

        Inclusions::create([
            'inclusion_name' => $validated['inclusion_name'],
        ]);

        return redirect()->back()->with('success', 'Inclusion created successfully');
    }

    /**
     * Delete an inclusion.
     */
    public function destroy($id)
    {
        $inclusion = Inclusions::findOrFail($id);
        $inclusion->delete();

        return redirect()->back()->with('success', 'Inclusion deleted successfully');
    }
}
