<?php

namespace App\Http\Controllers;

use App\Models\Benefits;
use App\Models\Services;
use App\Models\Images;
use App\Models\Files;
use App\Models\Inclusions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::with('image.file')->orderBy('created_at', 'desc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $benefits = Benefits::all();
        $inclusions = Inclusions::all();
        return view('admin.services.create', compact('benefits', 'inclusions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'why_it_matters' => 'nullable|string|max:6000',
            'service_image' => 'nullable|image|max:2048',
            'icon_image' => 'nullable|image|max:2048',
            'benefits' => 'nullable|array',
            'benefits.*' => 'exists:benefits,id',
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'exists:inclusions,id',
        ]);

        try {
            $serviceImageId = null;
            $iconImageId = null;

            // 🖼 Handle Service Image
            if ($request->hasFile('service_image')) {
                $file = $request->file('service_image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Move manually to public/storage/services
                $file->move(public_path('storage/services'), $filename);

                $fileRecord = Files::create(['image_path' => 'services/' . $filename]);
                $image = Images::create([
                    'file_id' => $fileRecord->id,
                    'uploaded_by_id' => auth()->id(),
                    'alt_text' => $request->title . ' Image',
                ]);
                $serviceImageId = $image->id;
            }

            // 🧩 Handle Icon Image
            if ($request->hasFile('icon_image')) {
                $file = $request->file('icon_image');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Move manually to public/storage/services/icons
                $file->move(public_path('storage/services/icons'), $filename);

                $fileRecord = Files::create(['image_path' => 'services/icons/' . $filename]);
                $image = Images::create([
                    'file_id' => $fileRecord->id,
                    'uploaded_by_id' => auth()->id(),
                    'alt_text' => $request->title . ' Icon',
                ]);
                $iconImageId = $image->id;
            }

            // 📝 Create Service
            $service = Services::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'why_it_matters' => $validated['why_it_matters'] ?? null,
                'service_image_id' => $serviceImageId,
                'icon_image_id' => $iconImageId,
            ]);

            // ✅ Attach selected Benefits (many-to-many)
            if (!empty($request->benefits)) {
                $service->benefits()->attach($request->benefits);
            }

            // ✅ Attach selected Inclusions (many-to-many)
            if (!empty($request->inclusions)) {
                $service->inclusions()->attach($request->inclusions);
            }

            return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
        } catch (\Throwable $e) {
            Log::error('Service store error: ' . $e->getMessage());
            return back()->withErrors('Failed to create service.');
        }
    }


    public function edit(Services $service)
    {
        // Load relationships for existing data
        $service->load([
            'image.file',
            'icon.file',
            'benefits',
            'inclusions'
        ]);

        // Get all available benefits & inclusions for the dropdowns
        $benefits = Benefits::all();
        $inclusions = Inclusions::all();

        return view('admin.services.edit', compact('service', 'benefits', 'inclusions'));
    }


    public function update(Request $request, Services $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'why_it_matters' => 'nullable|string',
            'service_image' => 'nullable|image|max:2048',
            'icon_image' => 'nullable|image|max:2048',
            'benefits' => 'nullable|array',
            'benefits.*' => 'exists:benefits,id',
            'inclusions' => 'nullable|array',
            'inclusions.*' => 'exists:inclusions,id',
        ]);

        DB::beginTransaction();

        try {
            $oldServiceImage = $service->service_image_id;
            $oldIconImage = $service->icon_image_id;

            // 🖼 Upload new service image first (don't delete old yet)
            if ($request->hasFile('service_image')) {
                $file = $request->file('service_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/services'), $filename);

                $fileRecord = Files::create(['image_path' => 'services/' . $filename]);
                $newImage = Images::create([
                    'file_id' => $fileRecord->id,
                    'uploaded_by_id' => auth()->id(),
                    'alt_text' => $request->title . ' Image',
                ]);

                $service->service_image_id = $newImage->id;
            }

            // 🧩 Upload new icon image first (don't delete old yet)
            if ($request->hasFile('icon_image')) {
                $file = $request->file('icon_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/services/icons'), $filename);

                $fileRecord = Files::create(['image_path' => 'services/icons/' . $filename]);
                $newIcon = Images::create([
                    'file_id' => $fileRecord->id,
                    'uploaded_by_id' => auth()->id(),
                    'alt_text' => $request->title . ' Icon',
                ]);

                $service->icon_image_id = $newIcon->id;
            }

            // ✏️ Update service data safely
            $service->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'why_it_matters' => $validated['why_it_matters'] ?? null,
                'service_image_id' => $service->service_image_id,
                'icon_image_id' => $service->icon_image_id,
            ]);

            // ✅ Sync relations
            $service->benefits()->sync($request->benefits ?? []);
            $service->inclusions()->sync($request->inclusions ?? []);

            // 🧹 After successful update, delete old files (if replaced)
            if ($request->hasFile('service_image') && $oldServiceImage && $service->service_image_id != $oldServiceImage) {
                $old = Images::find($oldServiceImage);
                if ($old && $old->file) {
                    $path = public_path('storage/' . $old->file->image_path);
                    if (file_exists($path)) unlink($path);
                    $old->file->delete();
                }
                $old?->delete();
            }

            if ($request->hasFile('icon_image') && $oldIconImage && $service->icon_image_id != $oldIconImage) {
                $old = Images::find($oldIconImage);
                if ($old && $old->file) {
                    $path = public_path('storage/' . $old->file->image_path);
                    if (file_exists($path)) unlink($path);
                    $old->file->delete();
                }
                $old?->delete();
            }

            DB::commit();

            return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Service update error: ' . $e->getMessage());
            return back()->withErrors('Failed to update service.');
        }
    }


    public function destroy($id)
    {
        try {
            $service = Services::findOrFail($id);

            // ✅ Delete Service Image (if exists)
            if ($service->image && $service->image->file) {
                $imagePath = public_path($service->image->file->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete DB records in correct order
                $service->image->file->delete();
                $service->image->delete();
            }

            // ✅ Delete Icon Image (if exists)
            if ($service->icon && $service->icon->file) {
                $iconPath = public_path($service->icon->file->image_path);
                if (file_exists($iconPath)) {
                    unlink($iconPath);
                }

                $service->icon->file->delete();
                $service->icon->delete();
            }

            // ✅ Delete Service Record
            $service->delete();

            return back()->with('success', 'Services deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete service: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete service.');
        }
    }
}
