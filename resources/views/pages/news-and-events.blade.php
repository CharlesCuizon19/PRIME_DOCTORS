@extends('layouts.app')

@section('title', 'News & Events')

@php
$chunkedNews = collect($news)->chunk(8);
@endphp


@section('content')
<div class="flex flex-col">
    <x-banner title1="Latest" title2="Updates" img_path='assets/news-and-events-banner.png' page="News & Events"
        breadcrumb="" />

    <div class="container py-32 mx-auto">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($chunkedNews as $chunk)
                <div class="swiper-slide">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                        @foreach ($chunk as $item)
                        <a href="{{ route('news-and-events.singlepage', ['id' => $item->id]) }}"
                            class="overflow-hidden cursor-pointer rounded-2xl" data-aos="zoom-in"
                            data-aos-duration="1000">
                            <div class="overflow-hidden rounded-2xl">
                                <img src="{{ asset($item->image && $item->image->file ? $item->image->file->image_path : 'assets/news-img1.png') }}"
                                    alt="{{ $item->title }}"
                                    class="object-cover w-full h-[70%] rounded-2xl hover:scale-105 transition duration-300">
                            </div>
                            <div class="py-4">
                                <p class="flex items-center justify-start gap-2 mb-2 text-sm text-[#edb42f]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16">
                                        <path fill="currentColor"
                                            d="M6 7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5zM7.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m1 3h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5M10 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M4.5 0a.5.5 0 0 1 .5.5V1h6V.5a.5.5 0 0 1 1 0V1c1.66 0 3 1.34 3 3v8c0 1.66-1.34 3-3 3H4c-1.66 0-3-1.34-3-3V4c0-1.66 1.34-3 3-3V.5a.5.5 0 0 1 .5-.5M14 4v1H2V4c0-1.1.895-2 2-2v.5a.5.5 0 0 0 1 0V2h6v.5a.5.5 0 0 0 1 0V2c1.1 0 2 .895 2 2M2 12V6h12v6c0 1.1-.895 2-2 2H4c-1.1 0-2-.895-2-2"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</span>
                                </p>
                                <h2 class="text-base font-semibold text-gray-800 lg:text-lg text-start">
                                    {{ $item->title }}
                                </h2>
                            </div>
                        </a>
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