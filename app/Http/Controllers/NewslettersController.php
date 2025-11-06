<?php

namespace App\Http\Controllers;

use App\Exports\NewslettersExport;
use App\Models\Newsletter;
use App\Models\Newsletters;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NewslettersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = Newsletters::orderBy('created_at', 'desc')->get();
        return view('admin.newsletters.index', compact('newsletters'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns|max:255'
        ]);

        Newsletters::create([
            'email' => $validated['email'],
        ]);
        return redirect()->back()->with('success', 'Your newsletter has been submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $newsletter = Newsletters::findOrFail($id);
        $newsletter->delete();

        return redirect()->back()->with('success', 'Newsletter deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new NewslettersExport, 'newsletters.xlsx');
    }
}
