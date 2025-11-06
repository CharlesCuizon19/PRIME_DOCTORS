@extends('layouts.app')

@section('title', 'Careers')

@section('content')
    <div class="flex flex-col">
        <x-banner title1="Career" title2="Opportunities" img_path='assets/careers-banner.png' page="Careers /"
            breadcrumb="{{ $career->title }}" />

        <div class="bg-gray-100">
            <div class="grid h-full grid-cols-1 py-24">
                <div class="container grid grid-cols-1 mx-auto lg:flex">
                    <div class=" w-[66%] ">
                        <img src="{{ asset($career->image?->file?->image_path ?? 'assets/default-career.jpg') }}"
                            alt="{{ $career->image?->alt_text ?? $career->title }}"
                            class="object-cover w-full h-[28rem] rounded-3xl shadow-md">
                    </div>
                    <div class="flex flex-col items-start justify-between w-1/3 p-10 ">
                        <a href="{{ route('careers') }}" class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="text-[#0035c6]">
                                <rect width="24" height="24" fill="none" />
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m9 11l-4 4l4 4m-4-4h11a4 4 0 0 0 0-8h-1" />
                            </svg>
                            <div class="text-[#0035c6]">
                                Back to Careers
                            </div>
                        </a>
                        <div class="flex flex-col gap-3">
                            <div>
                                <span
                                    class="{{ $career->job_type === 'Part-time' ? 'bg-yellow-500 text-black' : 'bg-blue-600 text-white' }} px-2 py-1 text-md font-medium rounded">
                                    {{ $career->job_type }}
                                </span>
                            </div>
                            <div class="text-4xl font-medium">
                                {{ $career->title }}
                            </div>
                            <div class="flex items-center gap-2">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                        viewBox="0 0 24 22" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-clock-icon lucide-clock">
                                        <path d="M12 6v6l4 2" />
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg text-gray-500">
                                        Posted <span>{{ $career->monthsAgo }}</span> months ago
                                    </p>
                                </div>
                            </div>
                            <div class="w-fit">
                                <x-form career_name="{{ $career->career_name }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container grid grid-cols-1 gap-8 px-4 py-10 mx-auto lg:grid-cols-3">
                        <!-- LEFT CONTENT -->
                        <div class="col-span-2 space-y-8">
                            <!-- Employment Info -->
                            <div class="p-6 bg-white shadow rounded-xl">
                                <div class="pb-3 text-xl font-semibold border-b pattaya-regular">Employment Info</div>
                                <div class="grid grid-cols-3 pt-3 space-y-3">
                                    <section class="flex items-center col-span-1 gap-3">
                                        <img src="{{ asset('assets/career-icon1.png') }}" alt="" class="w-auto h-4">
                                        <div class="text-base text-gray-500">Vacancy</div>
                                    </section>
                                    <section class="col-span-2 text-lg">
                                        {{ $career->vacancy }}
                                    </section>

                                    <section class="flex items-center col-span-1 gap-3">
                                        <img src="{{ asset('assets/career-icon2.png') }}" alt=""
                                            class="w-auto h-4">
                                        <div class="text-base text-gray-500">Job Type</div>
                                    </section>
                                    <section class="col-span-2 text-lg">
                                        {{ $career->job_type }}
                                    </section>

                                    <section class="flex items-center col-span-1 gap-3">
                                        <img src="{{ asset('assets/career-icon3.png') }}" alt=""
                                            class="w-auto h-4">
                                        <div class="text-base text-gray-500">Experience</div>
                                    </section>
                                    <section class="col-span-2 text-lg">
                                        {{ $career->experience }}
                                    </section>

                                    <section class="flex items-center col-span-1 gap-3">
                                        <img src="{{ asset('assets/career-icon4.png') }}" alt=""
                                            class="w-auto h-4">
                                        <div class="text-base text-gray-500">Posted</div>
                                    </section>
                                    <section class="col-span-2 text-lg">
                                        <span>{{ $career->monthsAgo }}</span> months ago
                                    </section>

                                    <section class="flex items-center col-span-1 gap-3">
                                        <img src="{{ asset('assets/career-icon5.png') }}" alt=""
                                            class="w-auto h-4">
                                        <div class="text-base text-gray-500">Date Updated</div>
                                    </section>
                                    <section class="col-span-2 text-lg">
                                        {{ \Carbon\Carbon::parse($career->date_updated)->format('M d, Y') }}
                                    </section>
                                </div>
                            </div>

                            <!-- Overview -->
                            <div>
                                <div class="mb-3 text-3xl font-bold pattaya-regular">Overview</div>
                                <p class="text-gray-700">
                                    {!! $career->overview !!}
                                </p>
                            </div>

                            <!-- Key Responsibilities -->
                            <div>
                                <div class="mb-3 text-3xl font-bold pattaya-regular">Key Responsibilities</div>
                                <ul class="space-y-2 text-gray-700">
                                    @foreach ($career->responsibilities as $item)
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('assets/career-icon9.png') }}" alt=""
                                                class="w-auto h-4">
                                            <li class="flex items-start">
                                                {{ $item->responsibility }}
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Qualifications -->
                            <div>
                                <div class="mb-3 text-3xl font-bold pattaya-regular">Qualifications</div>
                                <ul class="space-y-2 text-gray-700">
                                    @foreach ($career->qualifications as $item)
                                        <li class="flex items-start">
                                            <span class="mr-2 text-yellow-500">✔</span>
                                            {{ $item->qualification }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                            <!-- Apply + Share -->
                            <div class="flex items-center justify-between">
                                <div class="w-fit">
                                    <x-form career_name="{{ $career->career_name }}" />
                                    </a>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="text-gray-600">Share:</span>
                                    <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24"
                                            class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f]">
                                            <path fill="currentColor"
                                                d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22 22 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202z" />
                                        </svg>
                                    </a>
                                    <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -0 24 24"
                                            class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f]">
                                            <path fill="currentColor"
                                                d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                        </svg>
                                    </a>
                                    <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -0 25 25"
                                            class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f]">
                                            <rect width="24" height="24" fill="none" />
                                            <path fill="currentColor"
                                                d="M6.94 5a2 2 0 1 1-4-.002a2 2 0 0 1 4 .002M7 8.48H3V21h4zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91z"
                                                stroke-width="0.5" stroke="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDEBAR -->
                        <div class="space-y-6">
                            <!-- Map + Contact -->
                            <div class="overflow-hidden rounded-2xl">
                                <div class="p-5 text-white bg-blue-600">
                                    Other Careers
                                </div>
                                <div class="flex flex-col gap-5 p-5 bg-white shadow">
                                    <iframe class="w-full h-40 border rounded border-[#edb42f]"
                                        src="https://maps.google.com/maps?q=Antipolo&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                                    <div class="mt-3 space-y-5 text-sm text-gray-700">
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('assets/career-icon6.png') }}" alt="">
                                            <div>
                                                Antipolo del Sur 4217 Lipa City, Philippines
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('assets/career-icon7.png') }}" alt="">
                                            <div>
                                                0917 327 7463
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('assets/career-icon8.png') }}" alt="">
                                            <div>
                                                primedoctorsmedicalcenter@gmail.com
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Other Careers -->
                            <div class="overflow-hidden rounded-2xl">
                                <div class="p-5 text-white bg-blue-600">Other Careers</div>
                                <div>
                                    <div
                                        class="flex flex-col gap-5 p-5 bg-white divide-y shadow h-[34rem] overflow-y-scroll">
                                        @foreach ($careers as $item)
                                            <a href="{{ route('careers.show', ['id' => $item->id]) }}"
                                                class="flex items-center p-3 space-x-3 transition duration-300 hover:bg-blue-600/10">
                                                <div class="h-auto overflow-hidden rounded-md w-44">
                                                    <img src="{{ asset($item->image?->file?->image_path ?? 'assets/default-career.jpg') }}"
                                                        alt="{{ $item->image?->alt_text ?? $item->title }}"
                                                        class="object-cover w-full h-32 rounded-md">

                                                </div>
                                                <div class="flex flex-col w-full gap-3">
                                                    <div>
                                                        <div class="font-semibold">{{ $item->title }}</div>
                                                        <p class="text-sm text-gray-500">Posted
                                                            <span>{{ $item->monthsAgo }}</span> months ago
                                                        </p>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <div class="flex items-center gap-2 text-sm text-gray-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="17" viewBox="0 0 20 20">
                                                                <rect width="20" height="20" fill="none" />
                                                                <path fill="currentColor"
                                                                    d="M7 8a3 3 0 1 0 0-6a3 3 0 0 0 0 6m7.5 1a2.5 2.5 0 1 0 0-5a2.5 2.5 0 0 0 0 5M1.615 16.428a1.22 1.22 0 0 1-.569-1.175a6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.95 9.95 0 0 1 7 18a9.95 9.95 0 0 1-5.385-1.572M14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 0 0-1.588-3.755a4.5 4.5 0 0 1 5.874 2.636a.82.82 0 0 1-.36.98A7.47 7.47 0 0 1 14.5 16"
                                                                    stroke-width="0.5" stroke="currentColor" />
                                                            </svg>
                                                            <span>
                                                                {{ $item->vacancy }}
                                                                {{ $item->vacancy > 1 ? ' vacancies' : ' vacancy' }}
                                                            </span>
                                                        </div>
                                                        <div
                                                            class="{{ $item->type === 'Part-time' ? 'text-black bg-yellow-500' : 'text-white bg-blue-600' }}  inline-block px-2 py-1 mt-1 text-xs rounded">
                                                            {{ $item->type }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
