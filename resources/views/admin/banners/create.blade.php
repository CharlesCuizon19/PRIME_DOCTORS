@extends('admin.layouts.adminapp')

@section('title', 'Homepage Banner / Create Banner')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">Create Banner</h1>

        {{-- ✅ Flash Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 p-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
            {{ session('error') }}
        </div>
        @endif

        {{-- ✅ Banner Form --}}
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('title') }}" placeholder="Enter banner title" required>
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Context (CKEditor) --}}
            <!-- <div>
                <label for="context" class="block text-sm font-semibold text-gray-700 mb-2">Context</label>
                <textarea name="context" id="context" rows="5"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Enter banner context (optional)">{{ old('context') }}</textarea>
                @error('context')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            {{-- Location --}}
            <!-- <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" name="location" id="location"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('location') }}" placeholder="e.g. Homepage, About Page">
                @error('location')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            {{-- Link --}}
            <!-- <div>
                <label for="link" class="block text-sm font-semibold text-gray-700 mb-2">Link (Optional)</label>
                <input type="url" name="link" id="link"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('link') }}" placeholder="https://example.com">
                @error('link')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> -->

            {{-- File Upload --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Image or Video</p>
                <p class="text-sm text-gray-500 mb-4">
                    Accepted formats: JPG, PNG, WEBP, MP4, MOV, AVI<br>
                    Max size: <strong>2MB (image)</strong> or <strong>25MB (video)</strong>
                </p>

                <label for="image" class="cursor-pointer inline-flex flex-col items-center bg-[#FBD55B] hover:bg-[#e4c14e] text-black font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select File</span>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*,video/*">
                </label>

                @error('image')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview Section --}}
            <div id="preview-container" class="hidden mt-4">
                <p class="font-semibold mb-2">Preview:</p>
                <div id="preview" class="relative inline-block rounded-lg overflow-hidden shadow-md"></div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.banners.index') }}"
                    class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit"
                    class="px-6 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg shadow hover:bg-[#e4c14e] transition">
                    Save Banner
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // ✅ Initialize CKEditor on the correct textarea
    ClassicEditor.create(document.querySelector('#context')).catch(console.error);

    // ✅ File Preview Logic
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        preview.innerHTML = "";
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            // Show preview section
            previewContainer.classList.remove('hidden');
            previewContainer.classList.add('block');

            let element;
            if (file.type.startsWith("image/")) {
                element = document.createElement("img");
                element.src = e.target.result;
                element.className = "w-full max-w-md h-auto rounded-lg shadow-lg object-cover";
            } else if (file.type.startsWith("video/")) {
                element = document.createElement("video");
                element.src = e.target.result;
                element.controls = true;
                element.className = "w-full max-w-md h-auto rounded-lg shadow-lg";
            }

            preview.appendChild(element);

            // Add remove button overlay
            const removeBtn = document.createElement("button");
            removeBtn.innerHTML = "✖";
            removeBtn.className =
                "absolute -top-3 -right-3 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-red-700 transition";
            removeBtn.onclick = function() {
                imageInput.value = "";
                preview.innerHTML = "";
                previewContainer.classList.add('hidden');
            };
            preview.appendChild(removeBtn);
        };
        reader.readAsDataURL(file);
    });
</script>
@endpush
@endsection