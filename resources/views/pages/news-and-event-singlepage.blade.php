@extends('layouts.app')

@section('title', 'News & Events')

@section('content')
<div class="flex flex-col">
    <x-banner title1="Latest" title2="Updates" img_path='assets/find-a-doctor-banner.png' page="News & Events"
        breadcrumb="{{ $news->title }}" />


    <div class="container flex flex-col gap-10 px-4 py-32 mx-auto md:px-8 lg:px-16 lg:flex-row">
        <!-- Left Section: Blog Article -->
        <div class="w-full lg:w-2/3">
            <!-- Featured Image -->
            <div class="w-full h-fit">
                @if ($news->image && $news->image->file && $news->image->file->image_path)
                <img src="{{ asset($news->image->file->image_path) }}"
                    alt="{{ $news->image->alt_text ?? $news->title }}"
                    class="object-cover w-full mb-6 rounded-2xl shadow-md">
                @else
                <img src="{{ asset('assets/post-details-img.png') }}"
                    alt="Default News Image"
                    class="object-cover w-full mb-6 rounded-2xl shadow-md opacity-80">
                @endif
            </div>

            <!-- Meta Info -->
            <div class="flex items-center gap-8 mb-3 text-sm text-gray-600">
                <p class="flex items-center justify-start gap-2 mb-2 text-sm text-[#edb42f]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        class="text-[#edb42f]">
                        <path fill="currentColor"
                            d="M19.652 19.405c.552-.115.882-.693.607-1.187c-.606-1.087-1.56-2.043-2.78-2.771C15.907 14.509 13.98 14 12 14s-3.907.508-5.479 1.447c-1.22.728-2.174 1.684-2.78 2.771c-.275.494.055 1.072.607 1.187a37.5 37.5 0 0 0 15.303 0"
                            stroke-width="0.5" stroke="currentColor" />
                        <circle cx="12" cy="8" r="5" fill="currentColor" stroke-width="0.5"
                            stroke="currentColor" />
                    </svg>
                    <span>Admin</span>
                </p>
                <p class="flex items-center justify-start gap-2 mb-2 text-sm text-[#edb42f]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path fill="currentColor"
                            d="M6 7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5zM7.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m1 3h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5M10 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M4.5 0a.5.5 0 0 1 .5.5V1h6V.5a.5.5 0 0 1 1 0V1c1.66 0 3 1.34 3 3v8c0 1.66-1.34 3-3 3H4c-1.66 0-3-1.34-3-3V4c0-1.66 1.34-3 3-3V.5a.5.5 0 0 1 .5-.5M14 4v1H2V4c0-1.1.895-2 2-2v.5a.5.5 0 0 0 1 0V2h6v.5a.5.5 0 0 0 1 0V2c1.1 0 2 .895 2 2M2 12V6h12v6c0 1.1-.895 2-2 2H4c-1.1 0-2-.895-2-2"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($news->blog_date)->format('F d, Y') }}</span>
                </p>
                <p class="flex items-center justify-start gap-2 mb-2 text-sm text-[#edb42f]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m11.4 18.161l7.396-7.396a10.3 10.3 0 0 1-3.326-2.234a10.3 10.3 0 0 1-2.235-3.327L5.839 12.6c-.577.577-.866.866-1.114 1.184a6.6 6.6 0 0 0-.749 1.211c-.173.364-.302.752-.56 1.526l-1.362 4.083a1.06 1.06 0 0 0 1.342 1.342l4.083-1.362c.775-.258 1.162-.387 1.526-.56q.647-.308 1.211-.749c.318-.248.607-.537 1.184-1.114m9.448-9.448a3.932 3.932 0 0 0-5.561-5.561l-.887.887l.038.111a8.75 8.75 0 0 0 2.092 3.32a8.75 8.75 0 0 0 3.431 2.13z"
                            stroke-width="0.5" stroke="currentColor" />
                    </svg>
                    <span>{{ $news->category->category_name ?? 'Uncategorized' }}</span>
                </p>
            </div>

            <!-- Title -->
            <div class="pb-5 text-2xl font-bold text-gray-800 border-b-2 lg:text-3xl">
                {{ $news->title }}
            </div>

            <!-- Content -->
            <div class="pt-5 space-y-6 leading-relaxed text-gray-700">
                <p>
                    {!! $news->context !!}
                </p>

                <h2 class="text-3xl italic font-semibold text-blue-700 pattaya-regular">
                    Why Regular Check-Ups Matter
                </h2>
                <p>
                    Regular medical visits are not just about treating illnesses — they are about preventing them. By
                    consulting
                    with your doctor periodically, you can monitor your overall well-being, track key health indicators,
                    and
                    address any concerns before they become serious.
                </p>

                <h2 class="text-3xl italic font-semibold text-blue-700 pattaya-regular">
                    Key Benefits of Routine Check-Ups
                </h2>
                <ul class="space-y-2 list-none">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 text-yellow-500">✔</span>
                        Conditions such as diabetes, hypertension, and certain cancers can be identified in their
                        earliest stages when treatment is most effective.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 text-yellow-500">✔</span>
                        Regular tests and screenings can highlight risk factors and allow for preventive measures.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 text-yellow-500">✔</span>
                        Doctors can provide lifestyle advice on diet, exercise, and habits tailored to your unique
                        health needs.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 text-yellow-500">✔</span>
                        Knowing your health status gives you confidence and reduces anxiety about potential illnesses.
                    </li>
                </ul>
            </div>
        </div>

        <!-- Right Section: Latest Posts -->
        <aside class="w-full lg:w-1/3">
            <div class="overflow-hidden bg-white shadow-md rounded-xl">
                <div class="px-6 py-3 font-semibold text-white bg-blue-700">Latest Post</div>
                <div class="divide-y">
                    <!-- Post Item -->
                    @foreach ($latest_news as $item)
                    <a href="{{ route('news-and-events.singlepage', ['id' => $item->id]) }}"
                        class="flex items-center gap-4 p-4 transition duration-300 cursor-pointer hover:bg-blue-700/10">
                        <img src="{{ asset($item->thumbnail_image_id ?? 'assets/logo.png') }}" alt="Post"
                            class="object-cover w-20 h-20 rounded-lg">
                        <div class="space-y-3">
                            <h3 class="text-sm font-semibold leading-snug text-gray-800">
                                {{ $item->title }}
                            </h3>
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
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>

</div>
@endsection