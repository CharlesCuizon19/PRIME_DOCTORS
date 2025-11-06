<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\DoctorLanguages;
use App\Models\DoctorSpecializations;
use App\Models\Images;
use App\Models\Files;
use App\Models\Specializations;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the doctors.
     */
    public function index()
    {
        $doctors = Doctors::with(['specializations', 'languages', 'image.file'])->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create()
    {
        $specializations = Specializations::all();
        $languages = Languages::all();
        return view('admin.doctors.create', compact('specializations', 'languages'));
    }

    /**
     * Store a newly created doctor in storage.
     */
    public function store(Request $request)
    {
        Log::info('Doctor store method called', ['request_data' => $request->all()]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'clinic_room_number' => 'nullable|string|max:100',
            'clinic_hours' => 'nullable|string|max:100',
            'phone_num' => 'nullable|string|max:50',
            'telephone_num' => 'nullable|string|max:50',
            'doctor_image_id' => 'required|file|mimes:jpg,jpeg,png,webp|max:2048',

            // ✅ Validate specialization structure + enum type
            'specializations' => 'required|array',
            'specializations.*.id' => 'required|integer|exists:specializations,id',
            'specializations.*.type' => 'nullable|in:Primary,Secondary',

            // ✅ Validate languages if provided
            'languages' => 'nullable|array',
            'languages.*' => 'integer|exists:languages,id',
        ]);

        DB::beginTransaction();

        try {
            /** 🔹 Handle File Upload */
            $file = $request->file('doctor_image_id');
            if ($file->getSize() > 2 * 1024 * 1024) {
                return back()->withErrors(['doctor_image_id' => 'Image file too large!'])->withInput();
            }

            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/doctors'), $filename);
            $filePath = 'storage/doctors/' . $filename;

            // Create File record
            $fileModel = Files::create(['image_path' => $filePath]);

            // Create Image record
            $imageModel = Images::create([
                'file_id' => $fileModel->id,
                'uploaded_by_id' => auth()->id() ?? null,
                'alt_text' => $request->name . ' photo',
            ]);

            /** 🔹 Create Doctor record */
            $doctor = Doctors::create([
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'clinic_room_number' => $validated['clinic_room_number'] ?? null,
                'clinic_hours' => $validated['clinic_hours'] ?? null,
                'phone_num' => $validated['phone_num'] ?? null,
                'telephone_num' => $validated['telephone_num'] ?? null,
                'doctor_image_id' => $imageModel->id,
            ]);

            /** 🔹 Insert Specializations */
            foreach ($validated['specializations'] as $spec) {
                DoctorSpecializations::create([
                    'doctor_id' => $doctor->id,
                    'specialization_id' => $spec['id'],
                    // Default to Secondary if not provided
                    'type' => $spec['type'] ?? 'Secondary',
                ]);
            }

            /** 🔹 Insert Languages */
            if (!empty($validated['languages'])) {
                foreach ($validated['languages'] as $langId) {
                    DoctorLanguages::create([
                        'doctor_id' => $doctor->id,
                        'language_id' => $langId,
                    ]);
                }
            }

            DB::commit();
            Log::info('Doctor created successfully', ['doctor_id' => $doctor->id]);

            return redirect()->route('admin.doctors.index')
                ->with('success', 'Doctor created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing doctor', ['message' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong. Check logs.');
        }
    }

    /**
     * Show the form for editing the specified doctor.
     */
    public function edit($id)
    {
        $doctor = Doctors::with(['specializations', 'languages', 'image.file'])->findOrFail($id);
        $specializations = Specializations::all();
        $languages = Languages::all();
        return view('admin.doctors.edit', compact('doctor', 'specializations', 'languages'));
    }

    /**
     * Update the specified doctor in storage.
     */
    public function update(Request $request, $id)
    {
        Log::info('Doctor update method called', ['doctor_id' => $id, 'request_data' => $request->all()]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:20',
            'clinic_room_number' => 'nullable|string|max:100',
            'clinic_hours' => 'nullable|string|max:100',
            'phone_num' => 'nullable|string|max:50',
            'telephone_num' => 'nullable|string|max:50',
            'doctor_image_id' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',

            // ✅ Validate specialization structure + enum type
            'specializations' => 'required|array',
            'specializations.*.id' => 'required|integer|exists:specializations,id',
            'specializations.*.type' => 'nullable|in:Primary,Secondary',

            // ✅ Validate languages if provided
            'languages' => 'nullable|array',
            'languages.*' => 'integer|exists:languages,id',
        ]);

        DB::beginTransaction();

        try {
            $doctor = Doctors::findOrFail($id);

            /** 🔹 Handle File Upload (if a new one is provided) */
            $imageId = $doctor->doctor_image_id;

            if ($request->hasFile('doctor_image_id')) {
                $file = $request->file('doctor_image_id');

                if ($file->getSize() > 2 * 1024 * 1024) {
                    return back()->withErrors(['doctor_image_id' => 'Image file too large!'])->withInput();
                }

                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/doctors'), $filename);
                $filePath = 'storage/doctors/' . $filename;

                // Create new File + Image
                $fileModel = Files::create(['image_path' => $filePath]);
                $imageModel = Images::create([
                    'file_id' => $fileModel->id,
                    'uploaded_by_id' => auth()->id() ?? null,
                    'alt_text' => $request->name . ' photo',
                ]);

                $imageId = $imageModel->id;
            }

            /** 🔹 Update Doctor */
            $doctor->update([
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'clinic_room_number' => $validated['clinic_room_number'] ?? null,
                'clinic_hours' => $validated['clinic_hours'] ?? null,
                'phone_num' => $validated['phone_num'] ?? null,
                'telephone_num' => $validated['telephone_num'] ?? null,
                'doctor_image_id' => $imageId,
            ]);

            /** 🔹 Update Specializations */
            DoctorSpecializations::where('doctor_id', $doctor->id)->delete();
            foreach ($validated['specializations'] as $spec) {
                DoctorSpecializations::create([
                    'doctor_id' => $doctor->id,
                    'specialization_id' => $spec['id'],
                    'type' => $spec['type'] ?? 'Secondary',
                ]);
            }

            /** 🔹 Update Languages */
            DoctorLanguages::where('doctor_id', $doctor->id)->delete();
            if (!empty($validated['languages'])) {
                foreach ($validated['languages'] as $langId) {
                    DoctorLanguages::create([
                        'doctor_id' => $doctor->id,
                        'language_id' => $langId,
                    ]);
                }
            }

            DB::commit();
            Log::info('Doctor updated successfully', ['doctor_id' => $doctor->id]);

            return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating doctor', ['message' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong while updating the doctor. Check logs.');
        }
    }

    /**
     * Remove the specified doctor from storage.
     */
    public function destroy($id)
    {
        try {
            $doctor = Doctors::findOrFail($id);
            DoctorSpecializations::where('doctor_id', $doctor->id)->delete();
            DoctorLanguages::where('doctor_id', $doctor->id)->delete();
            $doctor->delete();

            return back()->with('success', 'Doctor deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Doctor delete error: ' . $e->getMessage());
            return back()->withErrors('Failed to delete doctor.');
        }
    }
}
