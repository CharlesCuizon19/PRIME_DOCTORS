<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the languages.
     */
    public function index()
    {
        $languages = Languages::orderBy('created_at', 'desc')->get();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new language.
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created language in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required|string|max:255|unique:languages,language',
        ]);

        try {
            Languages::create([
                'language' => $request->language,
            ]);

            return redirect()
                ->route('admin.languages.index')
                ->with('success', 'Language created successfully!');
        } catch (\Throwable $e) {
            Log::error('Language store error: ' . $e->getMessage());
            return back()->withErrors('Failed to create language.');
        }
    }

    /**
     * Show the form for editing the specified language.
     */
    public function edit(Languages $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified language in storage.
     */
    public function update(Request $request, Languages $language)
    {
        $request->validate([
            'language' => 'required|string|max:255|unique:languages,language,' . $language->id,
        ]);

        try {
            $language->update([
                'language' => $request->language,
            ]);

            return redirect()
                ->route('admin.languages.index')
                ->with('success', 'Language updated successfully!');
        } catch (\Throwable $e) {
            Log::error('Language update error: ' . $e->getMessage());
            return back()->withErrors('Failed to update language.');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(Languages $language)
    {
        try {
            $language->delete();

            return redirect()
                ->route('admin.languages.index')
                ->with('success', 'Language deleted successfully!');
        } catch (\Throwable $e) {
            Log::error('Language delete error: ' . $e->getMessage());
            return back()->withErrors('Failed to delete language.');
        }
    }
}
