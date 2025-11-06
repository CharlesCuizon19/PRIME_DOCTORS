<div class="h-full py-16 bg-no-repeat bg-cover" style="background-image: url({{ asset('assets/ourservices-bg.png') }});">
    <div class="container flex flex-col px-6 mx-auto">
        <!-- Section Tag -->
        <div class="flex justify-center mb-10" data-aos="zoom-in" data-aos-duration="1000">
            <span class="px-4 py-1 text-sm font-semibold text-blue-700 bg-white rounded-full">
                Our Services
            </span>
        </div>

        <!-- Title -->
        <h2 class="mb-5 text-2xl font-bold text-center text-[#0035c6] md:text-4xl lg:text-5xl pattaya-regular"
            data-aos="zoom-in" data-aos-duration="1000">
            Comprehensive Medical Services
        </h2>

        <!-- Swiper Container -->
        <div class="swiper" data-aos="zoom-in" data-aos-duration="1000">
            <div class="pt-10 lg:pt-24 swiper-wrapper">
                @foreach ($services as $service)
                <div class="w-full cursor-pointer hover:scale-105 transition duration-300 swiper-slide max-h-fit rounded-[3rem]">
                    <a href="{{ route('service.show', $service->id) }}">
                        <div class="relative p-6 text-center clip-box bg-white rounded-[3rem] lg:w-[20rem] lg:h-[25rem]">
                            <div class="flex flex-col items-center justify-around h-auto mt-5 lg:h-full">
                                <h3 class="mt-10 mb-5 text-xl font-bold text-[#0035c6] pattaya-regular">
                                    {{ $service->title }}
                                </h3>

                                <ul class="px-5 mb-6 space-y-2 text-sm text-gray-700 list-disc text-start">
                                    @if($service->benefits && $service->benefits->count() > 0)
                                    @foreach ($service->benefits as $benefit)
                                    <li>{{ $benefit->benefit_name }}</li>
                                    @endforeach
                                    @elseif($service->inclusions && $service->inclusions->count() > 0)
                                    @foreach ($service->inclusions as $inclusion)
                                    <li>{{ $inclusion->inclusion_name }}</li>
                                    @endforeach
                                    @else
                                    <li>No details available</li>
                                    @endif
                                </ul>

                                <a href="#"
                                    class="inline-flex items-center gap-2 font-semibold text-[#edb42f] hover:text-yellow-700">
                                    <span class="text-sm lg:text-lg"> Book a Consultation</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4 12h12.25L11 6.75l.66-.75l6.5 6.5l-6.5 6.5l-.66-.75L16.25 13H4z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="absolute transform left-[125px] lg:left-[138px] -top-6">
                            <div class="absolute  flex items-center justify-center w-20 h-20 bg-[#FBBF24] rounded-full shadow-md z-30">
                                <div class="flex items-center justify-center w-16 h-16 bg-white rounded-full">
                                    <img src="{{ asset('storage/' . $service->icon->file->image_path) }}"
                                        alt="{{ $service->title }} Icon"
                                        class="w-8 h-8 object-contain">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Swiper Pagination -->
            <div class="mt-5 lg:mt-20 swiper-pagination"></div>
        </div>

        <!-- Button -->
        <div class="flex justify-center mt-20" data-aos="zoom-in" data-aos-duration="1000">
            <a href="{{ route('services') }}"
                class="flex items-center gap-5 px-1 py-1 text-white transition duration-300 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
                <span class="ml-5 text-base">VIEW ALL SERVICES</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 lg:h-14">
                    <g fill="none" stroke="currentColor" stroke-width="1">
                        <circle cx="12" cy="12" r="10" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                    </g>
                </svg>
            </a>
        </div>
    </div>
</div>


<style>
    /* Custom styles for Swiper */
    .swiper,
    .doctors-swiper {
        width: 100%;
        padding-bottom: 0px;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-pagination {
        position: relative;
        bottom: 10px;
    }

    .swiper-button-next,
    .swiper-button-prev {
        color: #1e40af;
        /* Matches blue-700 theme */
    }
</style>

<script>
    const swiper = new Swiper('.swiper', {
        // Responsive breakpoints
        loop: true,
        slidesPerView: 1,
        spaceBetween: 32,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
            },
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });


    function toggleContent(containerId, contentId) {
        const allContainers = document.querySelectorAll('[id^="faqContainer"]');
        const allContents = document.querySelectorAll('[id^="content"]');
        const allDownIcons = document.querySelectorAll('.down');
        const allUpIcons = document.querySelectorAll('.up');

        // Close all FAQs first
        allContents.forEach(content => {
            content.style.maxHeight = '0px';
        });
        allContainers.forEach(container => {
            container.classList.remove('border-[#EDB42F]');
            container.classList.remove('divide-y');
            container.classList.remove('text-[#EDB42F]');
        });
        allDownIcons.forEach(icon => icon.classList.remove('hidden'));
        allUpIcons.forEach(icon => icon.classList.add('hidden'));

        // Open the clicked one
        const container = document.getElementById(containerId);
        const content = document.getElementById(contentId);
        const downIcon = container.querySelector('.down');
        const upIcon = container.querySelector('.up');

        if (content.style.maxHeight === '0px' || content.style.maxHeight === '') {
            content.style.maxHeight = content.scrollHeight + 'px';
            container.classList.add('border-[#EDB42F]');
            container.classList.add('text-[#EDB42F]');
            container.classList.add('divide-y');
            downIcon.classList.add('hidden');
            upIcon.classList.remove('hidden');
        }
    }
</script>