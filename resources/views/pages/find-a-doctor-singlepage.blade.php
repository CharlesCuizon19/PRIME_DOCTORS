@extends('layouts.app')

@section('title', 'Doctor')

@section('content')
    <div class="flex flex-col">
        <x-banner title1="Find a" title2="Doctor" img_path='assets/find-a-doctor-banner.png' page="Find a Doctor"
            breadcrumb="" />

        <div class="container py-32 mx-auto">
            <div>
                <div class="flex items-center justify-between pb-10 border-b">
                    <div class="font-bold text-blue-700">
                        Results
                    </div>
                    <div class="flex items-center justify-center cursor-pointer">
                        <a href="{{ route('find-a-doctor.show') }}"
                            class="flex items-center justify-center gap-5 py-1 pl-5 pr-1 text-white transition duration-300 bg-blue-700 rounded-full shadow hover:scale-105 w-fit">
                            <div class="text-lg font-semibold">SEARCH OTHER DOCTOR</div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="p-2 border border-white rounded-full size-10">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M14.385 15.446a6.75 6.75 0 1 1 1.06-1.06l5.156 5.155a.75.75 0 1 1-1.06 1.06zm-7.926-1.562a5.25 5.25 0 1 1 7.43-.005l-.005.005l-.005.004a5.25 5.25 0 0 1-7.42-.004"
                                    clip-rule="evenodd" stroke-width="0.4" stroke="currentColor" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col pt-10 space-y-8">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"
                            class="text-[#edb42f]">
                            <path fill="currentColor"
                                d="M19.652 19.405c.552-.115.882-.693.607-1.187c-.606-1.087-1.56-2.043-2.78-2.771C15.907 14.509 13.98 14 12 14s-3.907.508-5.479 1.447c-1.22.728-2.174 1.684-2.78 2.771c-.275.494.055 1.072.607 1.187a37.5 37.5 0 0 0 15.303 0"
                                stroke-width="0.5" stroke="currentColor" />
                            <circle cx="12" cy="8" r="5" fill="currentColor" stroke-width="0.5"
                                stroke="currentColor" />
                        </svg>
                        <div class="text-lg font-semibold text-[#0035c6]">
                            Searched Doctors
                            <span class="text-xs">({{ $doctor_count }})</span>
                        </div>
                    </div>

                    @if ($doctor_count > 0)
                        <div class="grid grid-cols-1 gap-5 2xl:grid-cols-4">
                            @foreach ($doctors as $doctor)
                                <a href="{{ route('find-a-doctor.doctor-details', ['id' => $doctor->id]) }}"
                                    class="flex flex-col justify-end transition duration-300 bg-white border rounded-lg shadow-md hover:border-blue-700 bg-opacity-80">
                                    <img src="{{ asset('assets/doctor-thumbnail.png') }}" alt="Doctor Thumbnail"
                                        class="object-cover rounded-md">
                                    <div class="p-4">
                                        <h3 class="font-semibold text-blue-700">{{ $doctor->name }}</h3>
                                        <p class="text-lg text-[#edb42f]">
                                            {{ $doctor->specializations->filter(fn($s) => $s->pivot->type === 'Primary')->pluck('specialization_name')->implode(', ') }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="py-10 text-center text-gray-500">
                            No doctors found matching your search.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // ✅ Hide query string (e.g. ?specialization=IT) after page load
        document.addEventListener('DOMContentLoaded', function() {
            const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        });
    </script>

@endsection
