@extends('admin.layouts.adminapp')

@section('title', 'Services / Create Service')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">Create Service</h1>

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

        {{-- ✅ Service Form --}}
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('title') }}" placeholder="Enter service title" required>
                @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="5"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Describe this service">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Why It Matters --}}
            <div>
                <label for="why_it_matters" class="block text-sm font-semibold text-gray-700 mb-2">Why It Matters</label>
                <textarea name="why_it_matters" id="why_it_matters" rows="3"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Explain why this service is important">{{ old('why_it_matters') }}</textarea>

                @error('why_it_matters')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ✅ Benefits --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Select Benefits</label>
                <div id="benefits-container" class="space-y-3">
                    <div class="flex gap-2">
                        <select name="benefits[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Benefit --</option>
                            @foreach($benefits as $benefit)
                            <option value="{{ $benefit->id }}">{{ $benefit->benefit_name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="add-benefit px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>

                    </div>
                </div>
            </div>

            {{-- ✅ Inclusions --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Select Inclusions</label>
                <div id="inclusions-container" class="space-y-3">
                    <div class="flex gap-2">
                        <select name="inclusions[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Inclusion --</option>
                            @foreach($inclusions as $inclusion)
                            <option value="{{ $inclusion->id }}">{{ $inclusion->inclusion_name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="add-inclusion px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>

                    </div>
                </div>
            </div>

            {{-- Service Image --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Service Image</p>
                <p class="text-sm text-gray-500 mb-4">Accepted formats: JPG, PNG, WEBP — Max size: 2MB</p>
                <label for="service_image"
                    class="cursor-pointer inline-flex flex-col items-center bg-[#FBD55B] hover:bg-[#e4c14e] text-black font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select Image</span>
                    <input type="file" name="service_image" id="service_image" class="hidden" accept="image/*">
                </label>

                <div id="service_image_preview_container" class="hidden mt-4">
                    <p class="font-semibold mb-2">Service Image Preview:</p>
                    <div id="service_image_preview" class="relative inline-block rounded-lg overflow-visible shadow-md"></div>
                </div>

                @error('service_image')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon Image --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Icon Image</p>
                <p class="text-sm text-gray-500 mb-4">Accepted formats: JPG, PNG, WEBP — Max size: 1MB</p>
                <label for="icon_image"
                    class="cursor-pointer inline-flex flex-col items-center bg-[#FBD55B] hover:bg-[#e4c14e] text-black font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select Icon</span>
                    <input type="file" name="icon_image" id="icon_image" class="hidden" accept="image/*">
                </label>

                <div id="icon_image_preview_container" class="hidden mt-4">
                    <p class="font-semibold mb-2">Icon Image Preview:</p>
                    <div id="icon_image_preview" class="relative inline-block rounded-lg overflow-visible shadow-md"></div>
                </div>

                @error('icon_image')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.services.index') }}"
                    class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit"
                    class="px-6 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg shadow hover:bg-[#e4c14e] transition">
                    Save Service
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ✅ CKEditor
        ClassicEditor.create(document.querySelector('#description')).catch(console.error);
        ClassicEditor.create(document.querySelector('#why_it_matters')).catch(console.error);

        // ✅ Benefits container (add/remove)
        const benefitsContainer = document.getElementById('benefits-container');
        benefitsContainer.addEventListener('click', (e) => {
            if (e.target.matches('.add-benefit')) {
                const newRow = benefitsContainer.firstElementChild.cloneNode(true);
                newRow.querySelector('select').value = '';

                // Change button to remove
                const btn = newRow.querySelector('.add-benefit');
                btn.textContent = '−';
                btn.classList.remove('add-benefit', 'bg-[#FBD55B]');
                btn.classList.add('remove-benefit', 'bg-red-500', 'hover:bg-red-600');

                benefitsContainer.appendChild(newRow);
            }

            if (e.target.matches('.remove-benefit')) {
                const row = e.target.closest('div.flex');
                if (benefitsContainer.children.length > 1) {
                    row.remove();
                }
            }
        });

        // ✅ Inclusions container (add/remove)
        const inclusionsContainer = document.getElementById('inclusions-container');
        inclusionsContainer.addEventListener('click', (e) => {
            if (e.target.matches('.add-inclusion')) {
                const newRow = inclusionsContainer.firstElementChild.cloneNode(true);
                newRow.querySelector('select').value = '';

                const btn = newRow.querySelector('.add-inclusion');
                btn.textContent = '−';
                btn.classList.remove('add-inclusion', 'bg-[#FBD55B]');
                btn.classList.add('remove-inclusion', 'bg-red-500', 'hover:bg-red-600');

                inclusionsContainer.appendChild(newRow);
            }

            if (e.target.matches('.remove-inclusion')) {
                const row = e.target.closest('div.flex');
                if (inclusionsContainer.children.length > 1) {
                    row.remove();
                }
            }
        });

        // ✅ Preview setup (Service & Icon)
        const previewSetup = (inputId, previewId, containerId) => {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(containerId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', (event) => {
                const file = event.target.files[0];
                preview.innerHTML = "";
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.classList.remove('hidden');
                    preview.innerHTML = `
                    <img src="${e.target.result}" class="w-full max-w-md h-auto rounded-lg shadow-lg object-cover">
                    <button type="button" class="absolute -top-3 -right-3 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-red-700 transition">✖</button>
                `;
                    preview.querySelector('button').onclick = function() {
                        input.value = '';
                        previewContainer.classList.add('hidden');
                    };
                };
                reader.readAsDataURL(file);
            });
        };

        previewSetup('service_image', 'service_image_preview', 'service_image_preview_container');
        previewSetup('icon_image', 'icon_image_preview', 'icon_image_preview_container');
    });
</script>

@endpush
@endsection