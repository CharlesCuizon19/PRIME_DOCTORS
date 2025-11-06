@props(['img_path', 'title1', 'title2', 'page', 'breadcrumb'])


<div class="mt-[6rem] lg:mt-0 pb-28">
    <div>
        <div class="hidden w-full h-auto lg:flex lg:absolute lg:h-[465px]">
            <div class="relative w-full">
                <img src="{{ asset($img_path) }}" alt="" class="object-cover lg:h-[465px] lg:w-full">
                <div class="absolute inset-0"></div>
            </div>
        </div>


        <!-- Overlay container -->
        <div class="container mx-auto">
            <div
                class="relative flex flex-col items-center justify-center gap-5 mx-3 mt-2 text-center lg:text-left lg:mt-0 lg:items-start">
                <div
                    class="flex flex-col items-center w-full gap-5 text-5xl font-bold lg:items-start lg:text-left lg:mt-[13rem]">
                    <div class="hidden lg:flex" data-aos="zoom-in" data-aos-duration="1000">
                        <p class="text-sm text-[#0035c6] lg:text-base">
                            Home / <span>{{ $page }}</span>
                            <span>
                                {{ $breadcrumb }}
                            </span>
                        </p>
                    </div>
                    <div data-aos="zoom-in" data-aos-duration="1000">
                        <span class="text-[#0035c6] lg:text-[100px] pattaya-regular">
                            {{ $title1 }} <span class="text-[#edb42f] pattaya-regular">{{ $title2 }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
