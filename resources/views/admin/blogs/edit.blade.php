@extends('admin.layouts.adminapp')

@section('title', 'Blogs / Edit Blog')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">Edit Blog</h1>

        {{-- Flash Messages --}}
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

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Enter blog title" required>
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select name="category_id" id="category_id"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5
        focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]" required>
                    <option value="">-- Select Category --</option>
                    @foreach($blogcategories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Blog Date --}}
            <div>
                <label for="blog_date" class="block text-sm font-semibold text-gray-700 mb-2">
                    Date <span class="text-red-500">*</span>
                </label>
                <input type="date" name="blog_date" id="blog_date"
                    value="{{ old('blog_date', \Carbon\Carbon::parse($blog->blog_date)->format('Y-m-d')) }}"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    required>
                @error('blog_date')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Context --}}
            <div>
                <label for="context" class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                <textarea name="context" id="context" rows="6"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Enter blog content">{{ old('context', $blog->context) }}</textarea>
                @error('context')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Blog Image Upload --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700 mb-4">Upload Blog Image</p>
                <label for="blog_image"
                    class="cursor-pointer inline-flex flex-col items-center bg-[#FBD55B] hover:bg-[#e4c14e] text-black font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select Image</span>
                    <input type="file" name="blog_image" id="blog_image" class="hidden" accept="image/*">
                </label>

                @error('blog_image')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror

                {{-- Current Image Preview --}}
                <div class="mt-4 flex flex-col items-center">
                    <label class="block font-semibold mb-2 text-center">Current Image</label>
                    @if ($blog->image && $blog->image->file && $blog->image->file->image_path)
                    <img src="{{ asset($blog->image->file->image_path) }}"
                        alt="{{ $blog->blog_image->alt_text ?? 'Blog Image' }}"
                        class="w-56 h-28 object-cover rounded shadow border mb-3">
                    @else
                    <p class="text-gray-400 italic text-center">No image uploaded.</p>
                    @endif
                </div>

            </div>

            {{-- Preview Section for New Upload --}}
            <div id="preview-container" class="hidden mt-4">
                <p class="font-semibold mb-2">Preview:</p>
                <div id="preview" class="relative inline-block rounded-lg overflow-visible shadow-md"></div>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.blogs.index') }}"
                    class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit"
                    class="px-6 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg shadow hover:bg-[#e4c14e] transition">
                    Update Blog
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#context')).catch(console.error);

    const imageInput = document.getElementById('blog_image');
    const previewContainer = document.getElementById('preview-container');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        preview.innerHTML = "";
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.classList.remove('hidden');
            previewContainer.classList.add('block');

            const img = document.createElement("img");
            img.src = e.target.result;
            img.className = "w-full max-w-md h-auto rounded-lg shadow-lg object-cover";

            preview.appendChild(img);

            const removeBtn = document.createElement("button");
            removeBtn.innerHTML = "✖";
            removeBtn.className =
                "absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-red-700 transition";
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