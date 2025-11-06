@extends('layouts.app')

@section('title', 'Find a Doctor')

@section('content')
    <div class="flex flex-col">
        <x-banner title1="Find a" title2="Doctor" img_path='assets/find-a-doctor-banner.png' page="Find a Doctor"
            breadcrumb="" />

        <!-- Search & Info Section -->
        <div class="py-32 bg-gray-50">
            <div class="container grid items-start grid-cols-1 gap-10 mx-auto lg:grid-cols-2">

                <!-- Left Form -->
                <div class="h-full p-10 bg-white shadow rounded-2xl" data-aos="zoom-in" data-aos-duration="1000">
                    <form class="flex flex-col justify-between h-full space-y-6">

                        <!-- Doctor Name -->
                        <div>
                            <label class="block mb-1 text-lg font-semibold text-blue-700">Doctor Name</label>
                            <select id="doctorSelect"
                                class="w-full px-3 py-2 border rounded-full focus:ring focus:ring-blue-200">
                                <option value="">Select a Doctor</option>
                                @foreach ($doctors as $doctor)
                                    @php
                                        $primarySpecializations = $doctor->specializations
                                            ->filter(fn($s) => $s->pivot->type === 'Primary')
                                            ->pluck('specialization_name')
                                            ->implode(', ');

                                        $secondarySpecializations = $doctor->specializations
                                            ->filter(fn($s) => $s->pivot->type === 'Secondary')
                                            ->pluck('specialization_name')
                                            ->implode(', ');

                                        $languages = $doctor->languages->pluck('language')->implode(', ');
                                    @endphp

                                    <option value="{{ $doctor->id }}" data-gender="{{ $doctor->gender }}"
                                        data-language="{{ $languages }}"
                                        data-specialization="{{ $primarySpecializations }}"
                                        data-subspecialization="{{ $secondarySpecializations }}">
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gender & Language -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label class="block mb-1 text-lg font-semibold text-blue-700">Gender</label>
                                <select id="genderSelect"
                                    class="w-full px-3 py-2 border rounded-full focus:ring focus:ring-blue-200">
                                    <option>Select a Gender</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-1 text-lg font-semibold text-blue-700">Language</label>
                                <select id="languageSelect"
                                    class="w-full px-3 py-2 border rounded-full focus:ring focus:ring-blue-200">
                                    <option>Select a Language</option>
                                </select>
                            </div>
                        </div>

                        <!-- Specialization -->
                        <div>
                            <label class="block mb-1 text-lg font-semibold text-blue-700">Specialization</label>
                            <select id="specializationSelect"
                                class="w-full px-3 py-2 border rounded-full focus:ring focus:ring-blue-200">
                                <option>Select a Specialization</option>
                            </select>
                        </div>

                        <!-- Sub-specialization -->
                        <div>
                            <label class="block mb-1 text-lg font-semibold text-blue-700">Sub-specialization</label>
                            <select id="subspecializationSelect"
                                class="w-full px-3 py-2 border rounded-full focus:ring focus:ring-blue-200">
                                <option>Select a Sub-specialization</option>
                            </select>
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-center justify-center w-full cursor-pointer">
                            <a id="searchDoctorBtn" href="{{ route('find-a-doctor.show') }}"
                                class="flex items-center justify-center gap-5 py-1 pl-5 pr-1 text-white transition duration-300 bg-blue-700 rounded-full shadow hover:scale-105 w-fit">
                                <div class="text-lg font-semibold">SEARCH DOCTOR</div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="p-2 border border-white rounded-full size-10">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M14.385 15.446a6.75 6.75 0 1 1 1.06-1.06l5.156 5.155a.75.75 0 1 1-1.06 1.06zm-7.926-1.562a5.25 5.25 0 1 1 7.43-.005l-.005.005l-.005.004a5.25 5.25 0 0 1-7.42-.004"
                                        clip-rule="evenodd" stroke-width="0.4" stroke="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Right Content -->
                <div class="space-y-6 full:text-left">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold text-blue-700 pattaya-regular" data-aos="zoom-in"
                            data-aos-duration="1000">
                            Find the Right Doctor for You
                        </h2>
                        <div class="pb-8 border-b-2 w-fit">
                            <img src="{{ asset('assets/findadoctor-img.png') }}" alt="Doctor with patient"
                                class="shadow rounded-xl full:mx-0 h-auto w-[38rem]" data-aos="zoom-in"
                                data-aos-duration="1000">
                        </div>
                    </div>
                    <p class="text-gray-600 w-[75%] top-3" data-aos="zoom-in" data-aos-duration="1000">
                        Your health is our priority. Use our Find a Doctor tool to connect with trusted specialists who meet
                        your medical needs, preferences, and language of care.
                    </p>
                </div>
            </div>
        </div>

        <!-- ✅ OUR DOCTORS SECTION (Now Below) -->
        <div class="container py-20 mx-auto" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-10 pattaya-regular">Our Doctors</h2>
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($doctors as $doctor)
                    <div
                        class="flex flex-col items-center p-6  bg-gray-50 shadow rounded-2xl hover:shadow-lg transition duration-300">
                        <img src="{{ asset($doctor->image->file->image_path) }}"
                            alt="{{ $doctor->image->alt_text ?? $doctor->name }}"
                            class="rounded-[15px] h-[20rem] w-auto shadow-black drop-shadow-md object-cover">
                        <h3 class="text-lg font-semibold text-blue-800">{{ $doctor->name }}</h3>
                        <p class="text-lg text-gray-600">
                            {{ $doctor->specializations->pluck('specialization_name')->implode(', ') }}</p>
                        <a href="{{ route('find-a-doctor.doctor-details', $doctor->id) }}"
                            class="mt-4 text-blue-600 text-lg font-semibold hover:underline">View Profile</a>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const doctorSelect = document.getElementById('doctorSelect');
            const genderSelect = document.getElementById('genderSelect');
            const languageSelect = document.getElementById('languageSelect');
            const specializationSelect = document.getElementById('specializationSelect');
            const subspecializationSelect = document.getElementById('subspecializationSelect');
            const searchDoctorBtn = document.getElementById('searchDoctorBtn');

            const doctors = @json($doctors);

            // --- Collect unique values ---
            const genders = [...new Set(doctors.map(d => d.gender).filter(Boolean))];
            const languages = [...new Set(doctors.flatMap(d => d.languages.map(l => l.language)).filter(Boolean))];
            const specializations = [...new Set(doctors.flatMap(d =>
                d.specializations.filter(s => s.pivot.type === 'Primary').map(s => s
                    .specialization_name)
            ))];
            const subspecializations = [...new Set(doctors.flatMap(d =>
                d.specializations.filter(s => s.pivot.type === 'Secondary').map(s => s
                    .specialization_name)
            ))];

            populateDropdown(genderSelect, genders, 'Select a Gender');
            populateDropdown(languageSelect, languages, 'Select a Language');
            populateDropdown(specializationSelect, specializations, 'Select a Specialization');
            populateDropdown(subspecializationSelect, subspecializations, 'Select a Sub-specialization');

            function populateDropdown(selectEl, items, placeholder) {
                selectEl.innerHTML = `<option value="">${placeholder}</option>`;
                items.forEach(item => {
                    selectEl.innerHTML += `<option value="${item}">${item}</option>`;
                });
            }

            doctorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (!this.value) return;

                const gender = selectedOption.dataset.gender;
                const language = selectedOption.dataset.language;
                const specialization = selectedOption.dataset.specialization;
                const subspecialization = selectedOption.dataset.subspecialization;

                genderSelect.value = gender || "";

                // ✅ FIX: handle comma-separated languages
                if (language) {
                    const langList = language.split(',').map(l => l.trim());
                    const firstLang = langList[0];
                    languageSelect.value = firstLang;
                } else {
                    languageSelect.value = "";
                }

                specializationSelect.value = specialization || "";
                subspecializationSelect.value = subspecialization || "";
            });


            // --- When clicking "Search Doctor" ---
            searchDoctorBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const selectedDoctor = doctorSelect.value;
                const gender = genderSelect.value;
                const language = languageSelect.value;
                const specialization = specializationSelect.value;
                const subspecialization = subspecializationSelect.value;

                // If doctor is selected, go directly to their profile
                if (selectedDoctor) {
                    const routeTemplate = "{{ route('find-a-doctor.doctor-details', ['id' => ':id']) }}";
                    window.location.href = routeTemplate.replace(':id', selectedDoctor);
                    return;
                }

                // Otherwise, go to the results page (singlepage)
                const params = new URLSearchParams();
                if (gender) params.append('gender', gender);
                if (language) params.append('language', language);
                if (specialization) params.append('specialization', specialization);
                if (subspecialization) params.append('subspecialization', subspecialization);

                // ✅ Redirect to find-a-doctor.singlepage instead of find-a-doctor.show
                const searchRoute = "{{ route('find-a-doctor.results') }}";
                window.location.href = `${searchRoute}?${params.toString()}`;
            });
        });
    </script>

@endsection
