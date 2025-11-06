@extends('admin.layouts.adminapp')

@section('title', 'Edit Banner')

@section('admin-content')
    <!-- Page Title -->
    <h1 class="text-2xl font-semibold mb-6">EDIT HOMEPAGE BANNER</h1>

    <!-- Back Button -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.banners.index') }}"
            class="inline-flex items-center gap-2 text-lg bg-black text-white px-5 py-2 rounded-xl shadow-md hover:bg-gray-600 transition duration-200">
            <!-- Arrow Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 max-w-3xl mx-auto">
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block font-semibold mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Enter banner title" required>
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Context -->
            <!-- <div>
                <label class="block font-semibold mb-2">Context</label>
                <textarea name="context" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Enter short description or banner text">{{ old('context', strip_tags($banner->context)) }}</textarea>
                @error('context')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
            </div> -->



            <!-- Location -->
            <!-- <div>
                <label class="block font-semibold mb-2">Location</label>
                <input type="text" name="location" value="{{ old('location', $banner->location ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Homepage / About Page / etc.">
                @error('location')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
            </div> -->

            <!-- Link -->
            <!-- <div>
                <label class="block font-semibold mb-2">Link</label>
                <input type="text" name="link" value="{{ old('link', $banner->link) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none"
                    placeholder="Optional external or internal link">
                @error('link')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
            </div> -->

            <!-- Current Image Preview -->
            <div>
                <label class="block font-semibold mb-2">Current Banner</label>
                @if ($banner->image && $banner->image->file && $banner->image->file->image_path)
                    <img src="{{ asset($banner->image->file->image_path) }}"
                        alt="{{ $banner->image->alt_text ?? 'Banner' }}"
                        class="w-56 h-28 object-cover rounded shadow border mb-3">
                @else
                    <p class="text-gray-400 italic">No image uploaded.</p>
                @endif
            </div>

            <!-- Upload New Image -->
            <div>
                <label class="block font-semibold mb-2">Upload New Image (optional)</label>
                <input type="file" name="image"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none
                       file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-lg
                       file:bg-green-600 file:text-white hover:file:bg-green-700">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-green-600 to-emerald-500 text-white py-3 rounded-xl font-semibold shadow-md hover:shadow-lg hover:scale-[1.02] transition duration-200">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush
