<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentsExport;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AppointmentController extends Controller
{
    /**
     * Admin — Display all appointments
     */
    public function index()
    {
        $appointments = Appointment::with('doctor')->orderBy('created_at', 'desc')->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Frontend — Store appointment request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'appointment_date' => 'required|date|after_or_equal:today',
        ]);

        Appointment::create($validated);

        return redirect()->back()->with('success', 'Your appointment has been booked successfully!');
    }

    /**
     * Admin — Delete appointment
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new AppointmentsExport, 'appointments.xlsx');
    }
}
