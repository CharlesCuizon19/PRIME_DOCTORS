<div class="flex flex-col">
    <div class="overflow-x-hidden swiper2 myBannerSwiper">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
            @php
            $words = explode(' ', $banner->title);
            $first = $words[0] ?? '';
            $last = count($words) > 1 ? array_pop($words) : '';
            $middle = implode(' ', array_slice($words, 1));
            $imagePath = $banner->image?->file?->image_path
            ? asset($banner->image->file->image_path)
            : asset('assets/background.png');
            @endphp

            <div class="swiper-slide relative">
                <!-- Background Image -->
                <img src="{{ $imagePath }}" alt="{{ $banner->image?->alt_text ?? $banner->title }}"
                    class="h-[12rem] w-full object-cover lg:h-auto rounded-xl">

                <!-- Text Overlay -->
                <div
                    class="container absolute inset-0 flex flex-col justify-center gap-2 px-4 mx-auto text-white lg:gap-7 text-start">
                    @if ($banner->context)
                    <div class="w-1/2 text-xs text-black lg:w-full lg:text-base" data-aos="zoom-in"
                        data-aos-duration="1000">
                        {!! $banner->context !!}
                    </div>
                    @endif

                    <!-- Title -->
                    <div class="text-2xl font-semibold lg:text-[6rem] lg:w-1/2 h-auto leading-tight"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <span class="text-[#edb42f] pattaya-regular">{{ $first }}</span>
                        @if ($middle)
                        <span class="text-[#0035c6] pattaya-regular"> {{ $middle }} </span>
                        @endif
                        <span class="text-[#edb42f] pattaya-regular">{{ $last }}</span>
                    </div>

                    <!-- Button -->
                    @if ($banner->link)
                    <div class="bg-[#0035c6] rounded-full px-1 py-1 w-fit cursor-pointer hover:scale-105 shadow hover:shadow-lg transition duration-300"
                        data-aos="zoom-in" data-aos-duration="1000">
                        <a href="{{ $banner->link }}" class="flex items-center gap-2 lg:gap-5">
                            <span class="ml-5 text-xs lg:text-xl">
                                MAKE AN APPOINTMENT
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-7 lg:h-14">
                                <g fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                </g>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Lower Section -->
    <div class="relative hidden bg-gray-50 lg:flex">
        <img src="{{ asset('assets/straight bg.png') }}" alt="">

        <div class="container absolute inset-0 flex flex-row items-center mx-auto">
            <div class="flex items-center pr-[20rem] w-full gap-14 text-gray-800">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold text-white lg:text-sm">24/7 Emergency Services</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold text-white lg:text-sm">Specialized Doctors</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold text-white lg:text-sm">Patient-Centric Care</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const swiper2 = new Swiper(".myBannerSwiper", {
        loop: true,
        speed: 3000,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>