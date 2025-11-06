<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Banners;
use App\Models\Image;
use App\Models\File;
use App\Models\Files;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load banners with image and file data
        $banners = Banners::with('image.file')->orderBy('created_at', 'desc')->get();

        return view('admin.banners.index', compact('banners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Banner store method called', ['request_data' => $request->all()]);

        $request->validate([
            'title'       => 'required|string|max:255',
            'context'     => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'link'        => 'nullable|string|max:255',
            'image'       => 'required|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi',
        ]);

        try {
            $file = $request->file('image');
            $mimeType = $file->getMimeType();

            // Set max size based on type
            $maxSize = str_starts_with($mimeType, 'image/')
                ? 2 * 1024 * 1024   // 2 MB
                : 25 * 1024 * 1024; // 25 MB for video

            if ($file->getSize() > $maxSize) {
                return back()->withErrors(['image' => 'File too large!'])->withInput();
            }

            // ✅ Save file in /storage/banners
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/banners'), $filename);
            $filePath = 'storage/banners/' . $filename;

            // 1️⃣ Create File record
            $fileModel = Files::create(['image_path' => $filePath]);

            // 2️⃣ Create Image record (linked to File)
            $imageModel = Images::create([
                'file_id'        => $fileModel->id,
                'uploaded_by_id' => auth()->id() ?? null,
                'alt_text'       => $request->title ?? '',
            ]);

            $banner = Banners::create([
                'title'     => $request->title,
                'context'   => $request->context,
                'location'  => $request->location,
                'link'      => $request->link,
                'banner_image_id'  => $imageModel->id,
            ]);

            Log::info('Banner created successfully', ['banner_id' => $banner->id]);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing banner', ['message' => $e->getMessage()]);
            return back()->with('error', 'Something went wrong. Check logs.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banners $banner)
    {
        $banner->load('image.file');
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banners $banner)
    {
        Log::info('Banner update called', ['banner_id' => $banner->id]);

        $request->validate([
            'title'    => 'required|string|max:255',
            'context'  => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'link'     => 'nullable|string|max:255',
            'image'    => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov,avi',
        ]);

        try {
            // 📝 Update basic fields
            $banner->update([
                'title'    => $request->title,
                'context'  => $request->context,
                'location' => $request->location,
                'link'     => $request->link,
            ]);

            // 🖼 Handle image update (if provided)
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destination = public_path('storage/banners');
                $file->move($destination, $filename);
                $filePath = 'storage/banners/' . $filename;

                // Check if banner already has an image + file
                $existingImage = $banner->image;
                $oldFile = $existingImage?->file;

                if ($oldFile && file_exists(public_path($oldFile->image_path))) {
                    // 🗑 Delete old physical file
                    unlink(public_path($oldFile->image_path));

                    // 🔄 Just update DB path, keep record alive
                    $oldFile->update(['image_path' => $filePath]);
                } else {
                    // 🆕 No existing file record — create a new one
                    $fileModel = Files::create(['image_path' => $filePath]);

                    if ($existingImage) {
                        // If image record exists, just relink to new file
                        $existingImage->update(['file_id' => $fileModel->id]);
                    } else {
                        // If banner has no image record, create one
                        $imageModel = Images::create([
                            'file_id' => $fileModel->id,
                            'uploaded_by_id' => auth()->id() ?? null,
                            'alt_text' => $banner->title,
                        ]);
                        $banner->update(['banner_image_id' => $imageModel->id]);
                    }
                }
            }

            Log::info('Banner updated successfully', ['banner_id' => $banner->id]);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating banner', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ]);

            return back()->with('error', 'Something went wrong during update.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banners::with('image.file')->findOrFail($id);

        // Delete associated file
        $filePath = $banner->image?->file?->image_path;
        if ($filePath && file_exists(public_path($filePath))) {
            unlink(public_path($filePath));
            $banner->image->file->delete();
        }

        if ($banner->image) {
            $banner->image->delete();
        }

        $banner->delete();

        Log::info('Banner deleted successfully', ['banner_id' => $id]);
        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
