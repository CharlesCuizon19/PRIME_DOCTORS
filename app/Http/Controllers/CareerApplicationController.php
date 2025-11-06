<?php

namespace App\Http\Controllers;

use App\Models\CareerApplication;
use App\Models\Careers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CareerApplicationController extends Controller
{
    /**
     * Display a listing of all career applications.
     */
    public function index()
    {
        $applications = CareerApplication::with('career')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.career_applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new application.
     */
    public function create()
    {
        $careers = Careers::all();
        return view('admin.career_applications.create', compact('careers'));
    }

    /**
     * Store a newly created application.
     */
    public function store(Request $request)
    {
        Log::info('Career application store called', ['data' => $request->all()]);

        $request->validate([
            'career_id'             => 'required|exists:careers,id',
            'applicant_first_name'  => 'required|string|max:255',
            'applicant_last_name'   => 'required|string|max:255',
            'applicant_email'       => 'required|email|max:255',
            'applicant_phone'       => 'nullable|string|max:50',
            'resume'                => 'required|file|mimes:pdf,doc,docx|max:5120',
            'g-recaptcha-response'  => 'required',
        ]);

        // ✅ Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptcha = $response->json();
        if (!($recaptcha['success'] ?? false)) {
            Log::warning('reCAPTCHA validation failed', ['recaptcha' => $recaptcha]);
            return back()->withErrors(['g-recaptcha-response' => 'Please verify that you are not a robot.'])->withInput();
        }

        try {
            // ✅ Check if the selected career has available vacancies
            $career = Careers::findOrFail($request->career_id);
            if ($career->vacancy <= 0) {
                return back()->withErrors(['career_id' => 'This position is no longer available.'])->withInput();
            }

            // ✅ Upload resume file
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/career_applications'), $filename);
            $filePath = 'storage/career_applications/' . $filename;

            // ✅ Save record to database
            $application = CareerApplication::create([
                'career_id'             => $career->id,
                'applicant_first_name'  => $request->applicant_first_name,
                'applicant_last_name'   => $request->applicant_last_name,
                'applicant_email'       => $request->applicant_email,
                'applicant_phone'       => $request->applicant_phone,
                'file_path'             => $filePath,
            ]);

            // ✅ Decrease vacancy count
            $career->decrement('vacancy', 1);

            Log::info('Career application created successfully', ['id' => $application->id]);

            return back()->with('success', 'Application submitted successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing career application', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()->with('error', 'Something went wrong while saving.')->withInput();
        }
    }

    /**
     * Show the form for editing the specified application.
     */
    public function edit(CareerApplication $careerApplication)
    {
        $careers = Careers::all();
        return view('admin.career_applications.edit', compact('careerApplication', 'careers'));
    }

    /**
     * Update the specified application in storage.
     */
    public function update(Request $request, CareerApplication $careerApplication)
    {
        Log::info('Career application update called', ['id' => $careerApplication->id]);

        $request->validate([
            'career_id'             => 'required|exists:careers,id',
            'applicant_first_name'  => 'required|string|max:255',
            'applicant_last_name'   => 'required|string|max:255',
            'applicant_email'       => 'required|email|max:255',
            'applicant_phone'       => 'nullable|string|max:50',
            'resume'                => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        try {
            // ✅ If career changed, adjust vacancy counts
            if ($careerApplication->career_id != $request->career_id) {
                // Restore old career vacancy (+1)
                $oldCareer = Careers::find($careerApplication->career_id);
                if ($oldCareer) {
                    $oldCareer->increment('vacancy', 1);
                }

                // Decrease new career vacancy (-1)
                $newCareer = Careers::find($request->career_id);
                if ($newCareer && $newCareer->vacancy > 0) {
                    $newCareer->decrement('vacancy', 1);
                } else {
                    return back()->withErrors(['career_id' => 'This position is no longer available.'])->withInput();
                }
            }

            // ✅ Update basic applicant data
            $careerApplication->update([
                'career_id'             => $request->career_id,
                'applicant_first_name'  => $request->applicant_first_name,
                'applicant_last_name'   => $request->applicant_last_name,
                'applicant_email'       => $request->applicant_email,
                'applicant_phone'       => $request->applicant_phone,
            ]);

            // ✅ If new resume file uploaded
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('storage/career_applications');
                $file->move($destination, $filename);
                $filePath = 'storage/career_applications/' . $filename;

                // Delete old resume file if it exists
                if ($careerApplication->file_path && file_exists(public_path($careerApplication->file_path))) {
                    unlink(public_path($careerApplication->file_path));
                }

                $careerApplication->update(['file_path' => $filePath]);
            }

            Log::info('Career application updated successfully', ['id' => $careerApplication->id]);

            return redirect()->route('admin.career_applications.index')
                ->with('success', 'Application updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating career application', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
            ]);

            return back()->with('error', 'Something went wrong while updating.')->withInput();
        }
    }

    /**
     * Display the specified career application.
     */
    public function show($id)
    {
        $application = CareerApplication::with('career')->findOrFail($id);
        return view('admin.career_applications.show', compact('application'));
    }

    /**
     * Remove the specified application from storage.
     */
    public function destroy($id)
    {
        $application = CareerApplication::findOrFail($id);

        // ✅ Restore vacancy (+1)
        if ($application->career_id) {
            $career = Careers::find($application->career_id);
            if ($career) {
                $career->increment('vacancy', 1);
            }
        }

        // ✅ Delete resume file if exists
        if ($application->file_path && file_exists(public_path($application->file_path))) {
            unlink(public_path($application->file_path));
        }

        $application->delete();

        Log::info('Career application deleted successfully', ['id' => $id]);

        return redirect()->route('admin.career_applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
