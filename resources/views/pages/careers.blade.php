@extends('layouts.app')

@section('title', 'Careers')

@php
$chunkedCareers = collect($careers)->chunk(9); // Group careers into sets of 9
@endphp

@section('content')
<div class="flex flex-col">
    <x-banner title1="Career" title2="Opportunities" img_path='assets/careers-banner.png' page="Careers" breadcrumb="" />

    <div class="h-full py-24 bg-gray-100">
        <div class="container mx-auto">
            <div class="flex items-center mb-10 space-x-2 md:col-span-1" data-aos="zoom-in" data-aos-duration="1000">
                <span class="text-xl text-yellow-500">●</span>
                <h3 class="text-lg font-bold text-blue-900"><span
                        class="text-lg font-bold text-blue-900">{{ $careers_count }}</span> Open Positions</h3>
            </div>
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($chunkedCareers as $chunk)
                    <div class="swiper-slide">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($chunk as $career)
                            <!-- Job Card -->
                            <div data-aos="zoom-in" data-aos-duration="1000">
                                <a href="{{ route('careers.show', $career->id) }}">
                                    <div
                                        class="overflow-hidden transition duration-300 shadow cursor-pointer rounded-3xl group hover:shadow-lg bg-white">

                                        <!-- Career Image -->
                                        <div class="overflow-hidden relative">
                                            @if ($career->image && $career->image->file && $career->image->file->image_path)
                                            <img src="{{ asset(optional($career->image->file)->image_path ?? 'storage/career/default-service.jpg') }}"
                                                alt="{{ $career->image->alt_text ?? $service->title }}"
                                                class="object-cover w-full h-56 transition duration-300">
                                            @else
                                            <img src="{{ asset('assets/default-career.jpg') }}"
                                                alt="Default Career Image"
                                                class="object-cover w-full transition duration-300 lg:h-48 group-hover:scale-105 opacity-80">
                                            @endif

                                            <!-- Overlay badge for job type -->
                                            <span
                                                class="absolute top-3 right-3 px-3 py-1 text-xs font-medium rounded-full shadow-sm
                                                    {{ $career->job_type === 'Part-time' ? 'bg-yellow-400 text-gray-800' : 'bg-blue-600 text-white' }}">
                                                {{ $career->job_type }}
                                            </span>
                                        </div>

                                        <!-- Job Info -->
                                        <div class="flex flex-col p-4 space-y-3">
                                            <div class="flex flex-col gap-1 mb-5">
                                                <h3 class="text-lg font-semibold text-gray-800">{{ $career->career_name }}</h3>
                                                <p class="text-sm text-gray-500">
                                                    Posted <span>{{ $career->monthsAgo ?? '0' }}</span> month(s) ago
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Footer Info -->
                                        <div class="flex items-center justify-between p-4 text-sm text-gray-600 bg-[#f8f9fc] rounded-b-3xl">
                                            <div class="flex items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    class="w-auto h-6 text-black">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="currentColor"
                                                        d="M13.07 10.41a5 5 0 0 0 0-5.82A3.4 3.4 0 0 1 15 4a3.5 3.5 0 0 1 0 7a3.4 3.4 0 0 1-1.93-.59M5.5 7.5A3.5 3.5 0 1 1 9 11a3.5 3.5 0 0 1-3.5-3.5m2 0A1.5 1.5 0 1 0 9 6a1.5 1.5 0 0 0-1.5 1.5M16 17v2H2v-2s0-4 7-4s7 4 7 4m-2 0c-.14-.78-1.33-2-5-2s-4.93 1.31-5 2m11.95-4A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4Z"
                                                        stroke-width="0.5" stroke="currentColor" />
                                                </svg>
                                                <span>
                                                    <span>{{ $career->vacancy }}</span>
                                                    {{ $career->vacancy > 1 ? 'vacancies' : 'vacancy' }}
                                                </span>
                                            </div>

                                            <a href="{{ route('careers.show', $career->id) }}"
                                                class="flex items-center gap-1 px-3 font-medium text-blue-600 transition duration-300 border border-transparent hover:border-blue-600 rounded-xl">
                                                <span>Apply Now</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="w-auto h-3">
                                                    <rect width="1024" height="1024" fill="none" />
                                                    <path fill="currentColor"
                                                        d="M452.864 149.312a29.12 29.12 0 0 1 41.728.064L826.24 489.664a32 32 0 0 1 0 44.672L494.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L764.736 512L452.864 192a30.59 30.59 0 0 1 0-42.688m-256 0a29.12 29.12 0 0 1 41.728.064L570.24 489.664a32 32 0 0 1 0 44.672L238.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L508.736 512L196.864 192a30.59 30.59 0 0 1 0-42.688"
                                                        stroke-width="25.5" stroke="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-center w-auto gap-20 mt-10 lg:w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="z-20 h-12 transition duration-300 cursor-pointer text-[#0035c6] hover:scale-110 prev-btn"
                        data-swiper-action="prev">
                        <g fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m0 0l3-3m-3 3l3 3" />
                        </g>
                    </svg>
                    <div class="z-10 swiper-pagination w-fit"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="z-20 h-12 transition duration-300 cursor-pointer text-[#0035c6] hover:scale-110 next-btn"
                        data-swiper-action="next">
                        <g fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .swiper-pagination {
        width: 100% display: flex;
        gap: 10px;
    }

    .swiper-pagination-bullet {
        width: auto;
        height: auto;
        background: none;
        border: none;
        border-radius: 0;
        font-size: 16px;
        color: #000;
        opacity: 0.5;
        transition: opacity 0.3s ease, color 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: none;
        color: #007bff;
        opacity: 1;
        font-weight: bold;
    }
</style>

<script>
    const swiper = new Swiper('.swiper', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 0, // No space between slides since the grid handles spacing
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function(index, className) {
                return '<span class="text-2xl font-semibold text-[#0035c6] ' + className + '">' + (index +
                    1) + '</span>';
            },
        },
        navigation: {
            nextEl: '.next-btn',
            prevEl: '.prev-btn',
        },
    });
</script>
@endsection