<?php

namespace App\Http\Controllers;

use App\Exports\ConsultationsExport;
use App\Exports\ContactsExport;
use App\Models\Consultations;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultations::orderBy('created_at', 'desc')->get();
        return view('admin.consultation.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'contact_num' => 'required|digits:11',
        ]);

        Consultations::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact_num' => $validated['contact_num'],
        ]);
        return redirect()->back()->with('success1', 'Your consulation has been submitted successfully');
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
    public function destroy(Consultations $consultation)
    {
        $consultation->delete();
        return redirect()->back()->with('success', 'Consultation Deleted Successfully');
    }


    public function export()
    {
        return Excel::download(new ConsultationsExport, 'consultations.xlsx');
    }
}
