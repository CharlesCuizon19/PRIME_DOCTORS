@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="relative flex flex-col overflow-x-hidden">
    <x-banner title1="Our" title2="Services" img_path='assets/services-banner.png' page="Services" breadcrumb="" />

    <div class="bg-gray-100 py-32">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 gap-16 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $service)
                <div class="relative flex flex-col items-center text-center group" data-aos="zoom-in"
                    data-aos-duration="1000">

                    {{-- ✅ Floating Yellow Icon --}}
                    <div class="absolute -top-10 flex items-center justify-center w-20 h-20 bg-[#FBBF24] rounded-full shadow-md z-30">
                        <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full">
                            <img src="{{ asset('storage/' . $service->icon->file->image_path) }}"
                                alt="{{ $service->title }} Icon"
                                class="w-8 h-8 object-contain">
                        </div>
                    </div>

                    {{-- ✅ Card with Clip Shape --}}
                    <div
                        class="clip-box relative bg-white rounded-[2rem] pt-24 pb-10 px-8 w-full min-h-[350px] flex flex-col justify-between shadow-md hover:shadow-lg hover:-translate-y-2 transition duration-300 overflow-hidden z-10">

                        {{-- Top content --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 pattaya-regular">
                                {{ $service->title }}
                            </h3>

                            <ul class="text-gray-800 text-sm list-disc list-inside text-left space-y-1">
                                @if($service->inclusions && $service->inclusions->count() > 0)
                                @foreach ($service->inclusions as $inclusion)
                                <li>{{ $inclusion->inclusion_name }}</li>
                                @endforeach
                                @elseif($service->benefits && $service->benefits->count() > 0)
                                @foreach ($service->benefits as $benefit)
                                <li>{{ $benefit->benefit_name }}</li>
                                @endforeach
                                @else
                                <li>No details available.</li>
                                @endif
                            </ul>
                        </div>

                        {{-- ✅ Button always at bottom --}}
                        <div class="mt-8">
                            <a href="{{ route('service.show', $service->id) }}"
                                class="inline-flex items-center justify-center gap-2 text-[#EDB42F] font-semibold hover:text-yellow-600 transition">
                                <span>Book a Consultation</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M4 12h12.25L11 6.75l.66-.75l6.5 6.5l-6.5 6.5l-.66-.75L16.25 13H4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection