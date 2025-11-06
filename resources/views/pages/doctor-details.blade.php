@extends('layouts.app')

@section('title', 'Doctor Details')

@section('content')

@php
$primarySpecialization = $doctor->specializations->firstWhere('pivot.type', 'Primary');
$subSpecializations = $doctor->specializations->where('pivot.type', 'Secondary');
@endphp
<div class="flex flex-col bg-[#f5f5f5]">
    <x-banner title1="Doctor" title2="Details" img_path='assets/find-a-doctor-banner.png' page="Find a Doctor / "
        breadcrumb="{{ $doctor->name }}" />

    <div class="container py-32 mx-auto">
        <div class="flex flex-col gap-20">
            <div class="relative">
                <img src="{{ asset('assets/doctor-detials-bg.png') }}" alt="" class="w-full rounded-xl">

                <div class="absolute inset-0">
                    <div class="grid items-center h-full grid-cols-1 2xl:grid-cols-5">
                        <div class="ml-[10rem] col-span-2 w-fit">
                            @if ($doctor->image && $doctor->image->file && $doctor->image->file->image_path)
                            <img src="{{ asset($doctor->image->file->image_path) }}"
                                alt="{{ $doctor->image->alt_text ?? $doctor->name }}"
                                class="rounded-[15px] h-[20rem] w-auto shadow-black drop-shadow-md object-cover">
                            @else
                            <img src="{{ asset('assets/doctor-thumbnail2.png') }}"
                                alt="Default Doctor"
                                class="rounded-[15px] h-[20rem] w-auto shadow-black drop-shadow-md object-cover opacity-80">
                            @endif
                        </div>
                        <div class="flex flex-col col-span-3">
                            <div class="flex flex-col gap-3 pb-5 mr-10 border-b-2">
                                <div class="text-4xl text-[#0035c6]">
                                    {{ $doctor->name }}
                                </div>
                                <div class="text-md text-[#edb42f] font-semibold">
                                    <span class="text-[#edb42f]">{{ $primarySpecialization->specialization_name }}</span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-10 pt-5">
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Sub-specialization</span>
                                    <div>
                                        {{ $subSpecializations->pluck('specialization_name')->join(', ') }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Language</span>
                                    <div>
                                        {{ $doctor->languages->pluck('language')->join(', ') }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Clinic Room Number</span>
                                    <div>
                                        {{ $doctor->clinic_room_number }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Clinic Hours</span>
                                    <div>
                                        {{ $doctor->clinic_hours }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Phone Number</span>
                                    <div>
                                        {{ $doctor->phone_num }}
                                    </div>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <span class="text-sm font-semibold text-gray-500">Telephone Number</span>
                                    <div>
                                        {{ $doctor->telephone_num }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-32 rounded-lg lg:flex-row">
                <!-- Left Section: Appointment Form -->
                <div class="flex flex-col justify-between w-full rounded-lg lg:w-2/3">
                    <h2 class="mb-4 text-4xl italic font-semibold pattaya-regular">
                        Book an Appointment with
                        <span class="not-italic font-bold text-blue-700 pattaya-regular">
                            {{ $doctor->name }}
                        </span>
                    </h2>

                    <div class="overflow-hidden bg-white rounded-xl">
                        <div class="px-6 py-3 font-medium text-white bg-blue-700">
                            Appointment
                        </div>

                        <form class="p-6 space-y-6">
                            <div class="px-4 py-2 text-blue-600 border border-blue-600 rounded-full bg-blue-600/20">
                                {{ $primarySpecialization->specialization_name }}
                            </div>
                            <div class="px-4 py-2 text-blue-600 border border-blue-600 rounded-full bg-blue-600/20">
                                {{ $doctor->name }}
                            </div>
                            <input type="text" placeholder="Full Name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600" />
                            <input type="text" placeholder="Phone No."
                                class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600" />
                            <input type="date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600" />

                            <a href="#"
                                class="flex items-center justify-between w-fit px-1 py-1 text-white transition duration-300 gap-8 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
                                <span class="ml-5 text-base">BOOK YOUR APPOINTMENT</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 lg:h-11">
                                    <g fill="none" stroke="currentColor" stroke-width="1">
                                        <circle cx="12" cy="12" r="10" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                    </g>
                                </svg>
                            </a>
                        </form>

                    </div>
                    <p class="mt-5 text-sm italic text-gray-600">
                        Easily schedule a consultation with our trusted doctors. Whether you need routine check-ups,
                        specialized care, or professional medical advice, booking an appointment ensures you receive
                        timely and personalized healthcare.
                    </p>
                </div>

                <!-- Right Section: Find Another Doctor -->
                <div
                    class="flex flex-col w-full gap-5 p-5 overflow-hidden bg-white shadow-md h-fit rounded-xl lg:w-1/3">
                    <img src="{{ asset('assets/doctor-detials-img.png') }}" alt="Doctor consultation"
                        class="object-cover w-full h-auto rounded-xl" />

                    <div class="flex flex-col gap-3">
                        <h3 class="text-3xl italic font-semibold text-[#edb42f] pattaya-regular">Find Another Doctor
                        </h3>
                        <p class="text-sm text-gray-600">
                            Not the right match? Explore our full list of qualified specialists to find a doctor who
                            best fits your
                            healthcare needs.
                        </p>

                        <div class="flex items-start justify-start w-full cursor-pointer">
                            <a href="{{ route('find-a-doctor.show') }}"
                                class="flex items-center justify-center gap-5 py-1 pl-5 pr-1 text-white transition duration-300 bg-[#edb42f] rounded-full shadow hover:scale-105 w-fit">
                                <div class="text-sm font-semibold">FIND A DOCTOR</div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="p-2 border border-white rounded-full size-10">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M14.385 15.446a6.75 6.75 0 1 1 1.06-1.06l5.156 5.155a.75.75 0 1 1-1.06 1.06zm-7.926-1.562a5.25 5.25 0 1 1 7.43-.005l-.005.005l-.005.004a5.25 5.25 0 0 1-7.42-.004"
                                        clip-rule="evenodd" stroke-width="0.4" stroke="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection