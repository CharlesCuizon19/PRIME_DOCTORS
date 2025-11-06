@extends('admin.layouts.adminapp')

@section('title', 'Doctors / Create Doctor')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">Create Doctor</h1>

        {{-- ✅ Doctor Form --}}
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Doctor Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Doctor Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                    class="block w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('name') }}" placeholder="Enter doctor name" required>
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gender --}}
            <div>
                <label for="gender" class="block text-sm font-semibold text-gray-700 mb-2">
                    Gender <span class="text-red-500">*</span>
                </label>
                <select name="gender" id="gender"
                    class="block w-full border {{ $errors->has('gender') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    required>
                    <option value="">-- Select Gender --</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Clinic Room --}}
            <div>
                <label for="clinic_room_number" class="block text-sm font-semibold text-gray-700 mb-2">
                    Clinic Room Number
                </label>
                <input type="text" name="clinic_room_number" id="clinic_room_number"
                    class="block w-full border {{ $errors->has('clinic_room_number') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('clinic_room_number') }}" placeholder="Enter room number">
            </div>

            {{-- ✅ Clinic Hours Dropdown --}}
            <div>
                <label for="clinic_hours" class="block text-sm font-semibold text-gray-700 mb-2">
                    Clinic Hours
                </label>
                <select name="clinic_hours" id="clinic_hours"
                    class="block w-full border {{ $errors->has('clinic_hours') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <option value="">Select Clinic Hours</option>
                    <option value="Mon–Fri 8AM–12PM" {{ old('clinic_hours') == 'Mon–Fri 8AM–12PM' ? 'selected' : '' }}>Mon–Fri 8AM–12PM</option>
                    <option value="Mon–Fri 1PM–5PM" {{ old('clinic_hours') == 'Mon–Fri 1PM–5PM' ? 'selected' : '' }}>Mon–Fri 1PM–5PM</option>
                    <option value="Mon–Fri 9AM–6PM" {{ old('clinic_hours') == 'Mon–Fri 9AM–6PM' ? 'selected' : '' }}>Mon–Fri 9AM–6PM</option>
                    <option value="Mon–Sat 9AM–6PM" {{ old('clinic_hours') == 'Mon–Sat 9AM–6PM' ? 'selected' : '' }}>Mon–Sat 9AM–6PM</option>
                    <option value="Sat 9AM–1PM" {{ old('clinic_hours') == 'Sat 9AM–1PM' ? 'selected' : '' }}>Sat 9AM–1PM</option>
                    <option value="Sun 10AM–3PM" {{ old('clinic_hours') == 'Sun 10AM–3PM' ? 'selected' : '' }}>Sun 10AM–3PM</option>
                    <option value="Daily 8AM–8PM" {{ old('clinic_hours') == 'Daily 8AM–8PM' ? 'selected' : '' }}>Daily 8AM–8PM</option>
                </select>
                @error('clinic_hours')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Phone Number --}}
            <div>
                <label for="phone_num" class="block text-sm font-semibold text-gray-700 mb-2">
                    Mobile Number
                </label>
                <input type="text" name="phone_num" id="phone_num"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('phone_num') }}" placeholder="Enter phone number">
            </div>

            {{-- Telephone --}}
            <div>
                <label for="telephone_num" class="block text-sm font-semibold text-gray-700 mb-2">
                    Telephone Number
                </label>
                <input type="text" name="telephone_num" id="telephone_num"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('telephone_num') }}" placeholder="Enter telephone number">
            </div>

            {{-- ✅ Specializations --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Specializations <span class="text-red-500">*</span>
                </label>
                <div id="specializations-container" class="space-y-3">
                    <div class="flex gap-2 specialization-row">
                        <select name="specializations[0][id]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Specialization --</option>
                            @foreach($specializations as $spec)
                            <option value="{{ $spec->id }}">{{ $spec->specialization_name }}</option>
                            @endforeach
                        </select>
                        <select name="specializations[0][type]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Type --</option>
                            <option value="Primary">Primary</option>
                            <option value="Secondary">Secondary</option>
                        </select>
                        <button type="button"
                            class="add-specialization px-3 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">+</button>
                    </div>
                </div>
            </div>

            {{-- ✅ Languages --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Languages</label>
                <div id="languages-container" class="space-y-3">
                    <div class="flex gap-2 language-row">
                        <select name="languages[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Language --</option>
                            @foreach($languages as $lang)
                            <option value="{{ $lang->id }}">{{ $lang->language }}</option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="add-language px-3 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition">+</button>
                    </div>
                </div>
            </div>

            {{-- ✅ Doctor Image Upload --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Doctor Image</p>
                <p class="text-sm text-gray-500 mb-4">Accepted formats: JPG, PNG, WEBP (max 2MB)</p>

                <label for="doctor_image_id"
                    class="cursor-pointer inline-flex flex-col items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 15a4 4 0 014-4h.586a1 1 0 01.707.293l2.414 2.414a1 1 0 001.414 0l2.414-2.414a1 1 0 01.707-.293H17a4 4 0 014 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2v-1z" />
                    </svg>
                    <span>Select Image</span>
                    <input type="file" name="doctor_image_id" id="doctor_image_id" class="hidden" accept="image/*">
                </label>
            </div>

            {{-- ✅ Preview --}}
            <div id="preview-container" class="hidden mt-4">
                <p class="font-semibold mb-2">Preview:</p>
                <div id="preview" class="relative inline-block rounded-lg overflow-visible shadow-md"></div>
            </div>

            {{-- ✅ Buttons --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.doctors.index') }}"
                    class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                    Save Doctor
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ✅ SweetAlert for success/error
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
        @endif
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "{{ session('error') }}",
        });
        @endif

        // ✅ Dynamic Specializations
        let specIndex = 1;
        document.querySelector('#specializations-container').addEventListener('click', e => {
            if (e.target.classList.contains('add-specialization')) {
                const newRow = document.createElement('div');
                newRow.className = 'flex gap-2 specialization-row';
                newRow.innerHTML = `
                <select name="specializations[${specIndex}][id]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">-- Choose Specialization --</option>
                    @foreach($specializations as $spec)
                    <option value="{{ $spec->id }}">{{ $spec->specialization_name }}</option>
                    @endforeach
                </select>
                <select name="specializations[${specIndex}][type]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">-- Choose Type --</option>
                    <option value="Primary">Primary</option>
                    <option value="Secondary">Secondary</option>
                </select>
                <button type="button" class="remove-specialization px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
            `;
                e.target.closest('#specializations-container').appendChild(newRow);
                specIndex++;
            } else if (e.target.classList.contains('remove-specialization')) {
                e.target.closest('.specialization-row').remove();
            }
        });

        // ✅ Dynamic Languages
        document.querySelector('#languages-container').addEventListener('click', e => {
            if (e.target.classList.contains('add-language')) {
                const newLang = document.createElement('div');
                newLang.className = 'flex gap-2 language-row';
                newLang.innerHTML = `
                <select name="languages[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                    <option value="">-- Choose Language --</option>
                    @foreach($languages as $lang)
                    <option value="{{ $lang->id }}">{{ $lang->language }}</option>
                    @endforeach
                </select>
                <button type="button" class="remove-language px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
            `;
                e.target.closest('#languages-container').appendChild(newLang);
            } else if (e.target.classList.contains('remove-language')) {
                e.target.closest('.language-row').remove();
            }
        });

        // ✅ Image Preview
        const imageInput = document.getElementById('doctor_image_id');
        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('preview');
        imageInput.addEventListener('change', (event) => {
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
                preview.querySelector('button').addEventListener('click', () => {
                    imageInput.value = "";
                    preview.innerHTML = "";
                    previewContainer.classList.add('hidden');
                });
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
@endsection