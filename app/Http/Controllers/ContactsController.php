<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contacts::orderBy('created_at', 'desc')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contacts.create');
    }

    public function store(Request $request)
    {
        // ✅ Validate form fields + captcha presence
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'phone_num' => 'required|digits:11',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required', // ensure captcha field exists
        ]);

        // ✅ Verify reCAPTCHA with Google API
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $googleResponse = $response->json();

        // ✅ Log Google response (for debugging)
        Log::info('reCAPTCHA verification', ['response' => $googleResponse]);

        // ✅ If Google says "false", reject submission
        if (!($googleResponse['success'] ?? false)) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'Please verify that you are not a robot.'])
                ->withInput();
        }

        // ✅ Passed verification, save the contact
        Contacts::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone_num' => $validated['phone_num'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        return back()->with('success2', 'Your contact has been submitted successfully');
    }

    public function destroy(Contacts $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
}
