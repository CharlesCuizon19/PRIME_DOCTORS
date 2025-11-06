<?php

namespace App\Http\Controllers;

use App\Models\Benefits;
use Illuminate\Http\Request;

class BenefitsController extends Controller
{
    /**
     * Display all benefits.
     */
    public function index()
    {
        $benefits = Benefits::orderBy('created_at', 'desc')->get();
        return view('admin.benefits.index', compact('benefits'));
    }

    /**
     * Store a newly created benefit (AJAX).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'benefit_name' => 'required|string|max:255',
        ]);

        Benefits::create([
            'benefit_name' => $validated['benefit_name'],
        ]);

        return redirect()->back()->with('success', 'Benefits created successfully');
    }

    /**
     * Delete a benefit (AJAX).
     */

    public function destroy($id)
    {
        $benefit = Benefits::findOrFail($id);
        $benefit->delete();

        return redirect()->back()->with('success', 'Benefits deleted successfully');
    }
}
