@extends('admin.layouts.adminapp')

@section('title', 'Doctors / Edit Doctor')

@section('admin-content')
<div class="flex justify-center items-center min-h-[85vh] bg-gray-50">
    <div class="w-full max-w-screen-2xl bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 border-b pb-3">
            Edit Doctor
        </h1>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
        <div class="bg-red-100 p-4 rounded mb-4">
            <ul class="list-disc pl-5 text-red-600">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Doctor Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                    class="block w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('name', $doctor->name) }}" required>
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
                    <option value="Male" {{ old('gender', $doctor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $doctor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            {{-- Clinic Room --}}
            <div>
                <label for="clinic_room_number" class="block text-sm font-semibold text-gray-700 mb-2">
                    Clinic Room Number
                </label>
                <input type="text" name="clinic_room_number" id="clinic_room_number"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('clinic_room_number', $doctor->clinic_room_number) }}">
            </div>

            {{-- Clinic Hours --}}
            <div>
                <label for="clinic_hours" class="block text-sm font-semibold text-gray-700 mb-2">Clinic Hours</label>
                <select name="clinic_hours" id="clinic_hours"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    <option value="">Select Clinic Hours</option>
                    @foreach (['Mon–Fri 8AM–12PM','Mon–Fri 1PM–5PM','Mon–Fri 9AM–6PM','Mon–Sat 9AM–6PM','Sat 9AM–1PM','Sun 10AM–3PM','Daily 8AM–8PM'] as $hour)
                    <option value="{{ $hour }}" {{ old('clinic_hours', $doctor->clinic_hours) == $hour ? 'selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Phone & Telephone --}}
            <div>
                <label for="phone_num" class="block text-sm font-semibold text-gray-700 mb-2">Mobile Number</label>
                <input type="text" name="phone_num" id="phone_num"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('phone_num', $doctor->phone_num) }}">
            </div>
            <div>
                <label for="telephone_num" class="block text-sm font-semibold text-gray-700 mb-2">Telephone Number</label>
                <input type="text" name="telephone_num" id="telephone_num"
                    class="block w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    value="{{ old('telephone_num', $doctor->telephone_num) }}">
            </div>

            {{-- Specializations --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Specializations <span class="text-red-500">*</span></label>
                <div id="specializations-container" class="space-y-3" data-spec-count="{{ $doctor->specializations->count() }}">
                    @foreach($doctor->specializations as $index => $spec)
                    <div class="flex gap-2 specialization-row">
                        <select name="specializations[{{ $index }}][id]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Specialization --</option>
                            @foreach($specializations as $s)
                            <option value="{{ $s->id }}" {{ $spec->id == $s->id ? 'selected' : '' }}>{{ $s->specialization_name }}</option>
                            @endforeach
                        </select>
                        <select name="specializations[{{ $index }}][type]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="Primary" {{ $spec->pivot->type == 'Primary' ? 'selected' : '' }}>Primary</option>
                            <option value="Secondary" {{ $spec->pivot->type == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                        </select>
                        <button type="button" class="remove-specialization px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="add-specialization" class="px-3 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition mt-2">+ Add Specialization</button>
            </div>

            {{-- Languages --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Languages</label>
                <div id="languages-container" class="space-y-3" data-lang-count="{{ $doctor->languages->count() }}">
                    @foreach($doctor->languages as $lang)
                    <div class="flex gap-2 language-row">
                        <select name="languages[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">-- Choose Language --</option>
                            @foreach($languages as $l)
                            <option value="{{ $l->id }}" {{ $lang->id == $l->id ? 'selected' : '' }}>{{ $l->language }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="remove-language px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="add-language" class="px-3 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition mt-2">+ Add Language</button>
            </div>

            {{-- Doctor Image --}}
            <div class="border-2 border-dashed rounded-xl p-8 text-center bg-gray-50 hover:bg-gray-100 transition relative">
                <p class="font-semibold text-gray-700">Upload Doctor Image</p>
                <p class="text-sm text-gray-500 mb-4">Accepted formats: JPG, PNG, WEBP (max 2MB)</p>
                <label for="doctor_image_id" class="cursor-pointer inline-flex flex-col items-center bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                    <span>Select Image</span>
                    <input type="file" name="doctor_image_id" id="doctor_image_id" class="hidden" accept="image/*">
                </label>
                @if ($doctor->image && $doctor->image->file && $doctor->image->file->image_path)
                <div class="mt-4">
                    <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                    <img src="{{ asset($doctor->image->file->image_path) }}" alt="{{ $doctor->name }}" class="w-40 h-40 object-cover rounded-lg shadow-md mx-auto">
                </div>
                @endif
                <div id="preview-container" class="mt-4 hidden"></div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('admin.doctors.index') }}" class="px-4 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">← Back</a>
                <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">Update Doctor</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ✅ SweetAlert for flash messages
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
            text: "{{ session('error') }}"
        });
        @endif

        // Specializations
        const specContainer = document.getElementById('specializations-container');
        let specIndex = parseInt(specContainer.dataset.specCount);

        document.getElementById('add-specialization').addEventListener('click', () => {
            const row = document.createElement('div');
            row.className = 'flex gap-2 specialization-row';
            row.innerHTML = `
            <select name="specializations[${specIndex}][id]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                <option value="">-- Choose Specialization --</option>
                @foreach($specializations as $s)
                <option value="{{ $s->id }}">{{ $s->specialization_name }}</option>
                @endforeach
            </select>
            <select name="specializations[${specIndex}][type]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                <option value="Primary">Primary</option>
                <option value="Secondary" selected>Secondary</option>
            </select>
            <button type="button" class="remove-specialization px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
        `;
            specContainer.appendChild(row);
            specIndex++;
        });

        specContainer.addEventListener('click', e => {
            if (e.target.classList.contains('remove-specialization')) {
                e.target.closest('.specialization-row').remove();
            }
        });

        // Languages
        const langContainer = document.getElementById('languages-container');
        let langIndex = parseInt(langContainer.dataset.langCount);

        document.getElementById('add-language').addEventListener('click', () => {
            const row = document.createElement('div');
            row.className = 'flex gap-2 language-row';
            row.innerHTML = `
            <select name="languages[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2">
                <option value="">-- Choose Language --</option>
                @foreach($languages as $l)
                <option value="{{ $l->id }}">{{ $l->language }}</option>
                @endforeach
            </select>
            <button type="button" class="remove-language px-3 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">−</button>
        `;
            langContainer.appendChild(row);
            langIndex++;
        });

        langContainer.addEventListener('click', e => {
            if (e.target.classList.contains('remove-language')) {
                e.target.closest('.language-row').remove();
            }
        });

        // Image preview
        const imageInput = document.getElementById('doctor_image_id');
        const previewContainer = document.getElementById('preview-container');

        imageInput.addEventListener('change', e => {
            const file = e.target.files[0];
            previewContainer.innerHTML = '';
            if (!file) {
                previewContainer.classList.add('hidden');
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                previewContainer.classList.remove('hidden');
                previewContainer.innerHTML = `<img src="${e.target.result}" class="w-40 h-40 object-cover rounded-lg shadow-lg">`;
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush