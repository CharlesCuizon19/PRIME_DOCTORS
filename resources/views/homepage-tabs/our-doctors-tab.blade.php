<div class="bg-gray-50">
    <div>
        <div class="grid gap-10 px-4 mx-auto py-14 lg:py-16 lg:grid-cols-1 max-w-7xl">
            <!-- Section Titles -->
            <div class="flex items-center justify-center lg:justify-start lg:items-start" data-aos="zoom-in"
                data-aos-duration="1000">
                <span class="px-4 py-1 text-sm font-semibold text-blue-700 bg-white rounded-full w-fit h-fit">
                    Our Doctors
                </span>
            </div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center justify-center w-full lg:justify-start" data-aos="zoom-in"
                    data-aos-duration="1000">
                    <span class="text-2xl font-bold text-[#0035c6] lg:text-5xl pattaya-regular">
                        Meet the Professionals
                    </span>
                </div>
                <div class="justify-start hidden lg:flex" data-aos="zoom-in" data-aos-duration="1000">
                    <a href="{{ route('find-a-doctor.show') }}"
                        class="flex items-center gap-5 px-1 py-1 text-white transition duration-300 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
                        <span class="ml-5 text-base text-nowrap">VIEW ALL DOCTORS</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 lg:h-14">
                            <g fill="none" stroke="currentColor" stroke-width="1">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                            </g>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- ✅ Swiper -->
            <div class="overflow-hidden">
                <div class="swiper doctors-swiper" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="swiper-wrapper">
                        @foreach ($doctors as $doctor)
                        @php
                        $primarySpecialization = $doctor->specializations->firstWhere('pivot.type', 'Primary');
                        @endphp
                        <div class="swiper-slide">
                            <a href="{{ route('find-a-doctor.doctor-details', ['id' => $doctor->id]) }}"
                                class="flex flex-col justify-end w-full transition duration-300 bg-white border rounded-lg shadow-md hover:border-blue-700 bg-opacity-80">
                                <img src="{{ asset($doctor->image->file->image_path ?? 'assets/doctor-thumbnail.png') }}"
                                    alt="{{ $doctor->name }}"
                                    class="object-cover rounded-md">
                                <div class="p-4">
                                    <h3 class="font-semibold text-blue-700">{{ $doctor->name }}</h3>
                                    <p class="text-sm text-[#edb42f]">
                                        {{ $primarySpecialization?->specialization_name ?? 'No Primary Specialization' }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-center w-auto gap-4 lg:w-full" data-aos="zoom-in" data-aos-duration="1000">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-12 transition duration-300 cursor-pointer text-[#0035c6] hover:scale-110 prev-btn">
                    <g fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 12H8m0 0l3-3m-3 3l3 3" />
                    </g>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-12 transition duration-300 cursor-pointer text-[#0035c6] hover:scale-110 next-btn">
                    <g fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Initialize Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const doctorsSwiper = new Swiper('.doctors-swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 32,
            speed: 600,
            grabCursor: true,
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 4
                },
            },
        });

        document.querySelector('.prev-btn')?.addEventListener('click', () => doctorsSwiper.slidePrev());
        document.querySelector('.next-btn')?.addEventListener('click', () => doctorsSwiper.slideNext());
    });
</script>