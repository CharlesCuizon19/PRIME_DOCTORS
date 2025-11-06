@extends('admin.layouts.adminapp')

@section('title', 'Careers / Edit Career')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">Edit Career</h1>

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

        <form action="{{ route('admin.careers.update', $career->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Career Name --}}
            <div>
                <label for="career_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Career Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="career_name" id="career_name"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('career_name', $career->career_name) }}" placeholder="Enter career name" required>
                @error('career_name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Job Type --}}
            <div>
                <label for="job_type" class="block text-sm font-semibold text-gray-700 mb-2">
                    Job Type <span class="text-red-500">*</span>
                </label>
                <input type="text" name="job_type" id="job_type"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('job_type', $career->job_type) }}" placeholder="Enter job type" required>
                @error('job_type')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Experience --}}
            <div>
                <label for="experience" class="block text-sm font-semibold text-gray-700 mb-2">Experience</label>
                <input type="text" name="experience" id="experience"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('experience', $career->experience) }}" placeholder="Enter experience required">
                @error('experience')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Vacancy --}}
            <div>
                <label for="vacancy" class="block text-sm font-semibold text-gray-700 mb-2">Vacancy</label>
                <input type="number" name="vacancy" id="vacancy"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    value="{{ old('vacancy', $career->vacancy) }}" placeholder="Number of vacancies">
                @error('vacancy')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Overview --}}
            <div>
                <label for="overview" class="block text-sm font-semibold text-gray-700 mb-2">Overview</label>
                <textarea name="overview" id="overview" rows="5"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#FBD55B] focus:border-[#FBD55B]"
                    placeholder="Describe this career">{{ old('overview', $career->overview) }}</textarea>
                @error('overview')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Qualifications --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Select Qualifications</label>
                <div id="qualifications-container" class="space-y-3">
                    @forelse(old('qualification_ids', $career->qualifications->pluck('id')->toArray()) as $qualId)
                    <div class="flex gap-2">
                        <select name="qualification_ids[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Qualification --</option>
                            @foreach($qualifications as $qualification)
                            <option value="{{ $qualification->id }}" {{ $qualId == $qualification->id ? 'selected' : '' }}>
                                {{ $qualification->qualification }}
                            </option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="add-qualification px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>
                    </div>
                    @empty
                    <div class="flex gap-2">
                        <select name="qualification_ids[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Qualification --</option>
                            @foreach($qualifications as $qualification)
                            <option value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="add-qualification px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Responsibilities --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Select Responsibilities</label>
                <div id="responsibilities-container" class="space-y-3">
                    @forelse(old('responsibility_ids', $career->responsibilities->pluck('id')->toArray()) as $respId)
                    <div class="flex gap-2">
                        <select name="responsibility_ids[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Responsibility --</option>
                            @foreach($responsibilities as $responsibility)
                            <option value="{{ $responsibility->id }}" {{ $respId == $responsibility->id ? 'selected' : '' }}>
                                {{ $responsibility->responsibility }}
                            </option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="add-responsibility px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>
                    </div>
                    @empty
                    <div class="flex gap-2">
                        <select name="responsibility_ids[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Responsibility --</option>
                            @foreach($responsibilities as $responsibility)
                            <option value="{{ $responsibility->id }}">{{ $responsibility->responsibility }}</option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="add-responsibility px-3 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg hover:bg-[#e4c14e] transition">+</button>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Career Image --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Career Image</p>
                <p class="text-sm text-gray-500 mb-4">Accepted formats: JPG, PNG, WEBP — Max size: 2MB</p>

                {{-- Upload Button --}}
                <label for="career_image"
                    class="cursor-pointer inline-flex flex-col items-center bg-[#FBD55B] hover:bg-[#e4c14e] text-black font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select Image</span>
                    <input type="file" name="career_image" id="career_image" class="hidden" accept="image/*">
                </label>

                {{-- Preview --}}
                <div id="career_image_preview_container" class="{{ $career->image ? '' : 'hidden' }} mt-4">
                    <p class="font-semibold mb-2">Career Image Preview:</p>
                    <div id="career_image_preview" class="relative inline-block rounded-lg overflow-hidden shadow-md">
                        @if ($career->image && $career->image->file && $career->image->file->image_path)
                        <img src="{{ asset('storage/' . $career->image->file->image_path) }}"
                            onerror="this.src='{{ asset($career->image->file->image_path) }}'"
                            class="w-full max-w-md mx-auto mb-4 rounded-lg shadow-lg">
                        @else
                        <p class="text-gray-500 italic">No image uploaded.</p>
                        @endif
                    </div>
                </div>


                {{-- Validation Error --}}
                @error('career_image')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.careers.index') }}"
                    class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit"
                    class="px-6 py-2 bg-[#FBD55B] text-black font-semibold rounded-lg shadow hover:bg-[#e4c14e] transition">
                    Update Career
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor.create(document.querySelector('#overview')).catch(console.error);

        const handleDynamicFields = (containerId, addClass, removeClass) => {
            const container = document.getElementById(containerId);
            container.addEventListener('click', e => {
                if (e.target.matches(`.${addClass}`)) {
                    const newRow = container.firstElementChild.cloneNode(true);
                    newRow.querySelector('select').value = '';
                    const btn = newRow.querySelector(`.${addClass}`);
                    btn.textContent = '−';
                    btn.classList.replace(addClass, removeClass);
                    btn.classList.replace('bg-[#FBD55B]', 'bg-red-500');
                    btn.classList.add('hover:bg-red-600');
                    container.appendChild(newRow);
                } else if (e.target.matches(`.${removeClass}`)) {
                    if (container.children.length > 1) e.target.closest('div.flex').remove();
                }
            });
        };

        handleDynamicFields('qualifications-container', 'add-qualification', 'remove-qualification');
        handleDynamicFields('responsibilities-container', 'add-responsibility', 'remove-responsibility');

        // Image Preview
        const previewSetup = (inputId, previewId, containerId) => {
            const input = document.getElementById(inputId);
            const previewContainer = document.getElementById(containerId);
            const preview = document.getElementById(previewId);

            input.addEventListener('change', event => {
                const file = event.target.files[0];
                preview.innerHTML = '';
                if (!file) return;
                const reader = new FileReader();
                reader.onload = e => {
                    previewContainer.classList.remove('hidden');
                    preview.innerHTML = `
                    <img src="${e.target.result}" class="w-full max-w-md h-auto rounded-lg shadow-lg object-cover">
                    <button type="button" class="absolute -top-3 -right-3 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-red-700 transition">✖</button>`;
                    preview.querySelector('button').onclick = () => {
                        input.value = '';
                        previewContainer.classList.add('hidden');
                        preview.innerHTML = '';
                    };
                };
                reader.readAsDataURL(file);
            });
        };

        previewSetup('career_image', 'career_image_preview', 'career_image_preview_container');
    });
</script>
@endpush
@endsection