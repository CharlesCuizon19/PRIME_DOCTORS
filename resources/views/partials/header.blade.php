<header class="relative z-50 shadow drop-shadow-md">
    <!-- Top Bar -->
    {{-- <div class="py-1 text-sm text-white bg-blue-600">
            <div
                class="container flex flex-col items-center justify-between px-4 mx-auto space-y-2 sm:flex-row sm:space-y-0">
                <div class="flex flex-col items-center space-y-1 sm:flex-row sm:space-x-6 sm:space-y-0">
                    <span class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-5 text-[#edb42f]">
                            <path fill="currentColor"
                                d="M16 2A11.013 11.013 0 0 0 5 13a10.9 10.9 0 0 0 2.216 6.6s.3.395.349.452L16 30l8.439-9.953c.044-.053.345-.447.345-.447l.001-.003A10.9 10.9 0 0 0 27 13A11.013 11.013 0 0 0 16 2m0 15a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4" />
                            <circle cx="16" cy="13" r="4" fill="none" />
                        </svg>
                        <span>Antipolo del Sur 4217 Lipa City, Philippines</span>
                    </span>
                    <span class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 text-[#edb42f]">
                            <path fill="currentColor"
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                        </svg>
                        <span>primedoctorsmedicalcenter@gmail.com</span>
                    </span>
                </div>
            </div>
        </div> --}}

    <!-- Logo + Nav -->
    <div>
        <div class="relative">
            <img src="{{ asset('assets/header-bg.png') }}" alt="" class="w-full h-[7rem] z-10">

            <div class="container absolute inset-0 top-0 z-50 flex items-center justify-between mx-auto">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-20 lg:h-20">
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden space-x-6 md:flex">
                    <a href="{{ route('home') }}"
                        class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Home </a>
                    <a href="{{ route('about-us') }}"
                        class="{{ Route::is('about-us') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">About
                        Us</a>
                    <a href="{{ route('services') }}"
                        class="{{ Route::is('service.*') || Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">Services</a>
                    <a href="{{ route('careers') }}"
                        class="{{ Route::is('careers.*') || Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">Careers</a>
                    <a href="{{ route('find-a-doctor.show') }}"
                        class="{{ Route::is('find-a-doctor.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Find a Doctor</a>
                    <a href="{{ route('news-and-events.show') }}"
                        class="{{ Route::is('news-and-events.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">News
                        & Events</a>
                    <a href="{{ route('contact-us.show') }}"
                        class="{{ Route::is('contact-us.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">Contact
                        Us</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button id="menu-btn" class="text-gray-600 md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Mobile Nav -->
        <div id="menu" class="flex-col hidden px-6 pb-4 space-y-2 md:hidden bg-gray-50">
            <div>
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Home </a>
                <a href="{{ route('about-us') }}"
                    class="{{ Route::is('about-us') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    About Us </a>
                <a href="{{ route('services') }}"
                    class="{{ Route::is('service.*') || Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Services </a>
                <a href="{{ route('careers') }}"
                    class="{{ Route::is('careers.*') || Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Careers </a>
                <a href="{{ route('find-a-doctor.show') }}"
                    class="{{ Route::is('find-a-doctor.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Find a Doctor </a>
                <a href="{{ route('news-and-events.show') }}"
                    class="{{ Route::is('news-and-events.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    New & Events </a>
                <a href="{{ route('contact-us.show') }}"
                    class="{{ Route::is('contact-us.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Contact Us</a>
            </div>

            <!-- Features + Hotline -->
            <div class="bg-gray-50">
                <div
                    class="container flex flex-col items-center justify-between px-6 mx-auto space-y-4 lg:flex-row lg:space-y-0">
                    <div class="flex items-center justify-center text-gray-800 gap-14">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                            <span class="text-sm font-bold lg:text-sm">24/7 Emergency Services</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                            <span class="text-sm font-bold lg:text-sm">Specialized Doctors</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                            <span class="text-sm font-bold lg:text-sm">Patient-Centric Care</span>
                        </div>
                    </div>

                    <div
                        class="flex items-center w-full max-w-xs px-5 py-3 space-x-4 text-white bg-blue-600 rounded-lg shadow sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8">
                            <path fill="currentColor"
                                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                        </svg>
                        <span class="text-xl font-bold sm:text-2xl">0917 327 7463</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features + Hotline -->
    {{-- <div class="hidden bg-gray-50 lg:flex">
            <div class="flex flex-row items-center w-full">
                <div class="flex items-center justify-center pr-[20rem] w-full gap-14 text-gray-800">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-sm">24/7 Emergency Services</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-sm">Specialized Doctors</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-sm">Patient-Centric Care</span>
                    </div>
                </div>

                <div
                    class="flex items-center py-3 pl-5 space-x-4 text-white bg-blue-600 rounded-l-lg shadow pr-[15rem]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8">
                        <path fill="currentColor"
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                    </svg>
                    <span class="text-xl font-bold sm:text-2xl text-nowrap">0917 327 7463</span>
                </div>
            </div>
        </div> --}}
</header>

{{-- ON SCROLL --}}
<header id="header"
    class="fixed top-0 z-50 w-full transition-all duration-300 ease-out transform -translate-y-full opacity-0">

    <!-- Logo + Nav -->
    <div class="">
        <div class="relative">
            <img src="{{ asset('assets/header-bg.png') }}" alt="" class="w-full h-[7rem] z-10">

            <div class="container absolute inset-0 flex items-center justify-between mx-auto">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-20 sm:h-20">
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden space-x-6 md:flex">
                    <a href="{{ route('home') }}"
                        class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Home </a>
                    <a href="{{ route('about-us') }}"
                        class="{{ Route::is('about-us') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        About Us </a>
                    <a href="{{ route('services') }}"
                        class="{{ Route::is('service.*') || Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Services </a>
                    <a href="{{ route('careers') }}"
                        class="{{ Route::is('careers.*') || Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Careers </a>
                    <a href="{{ route('find-a-doctor.show') }}"
                        class="{{ Route::is('find-a-doctor.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Find a Doctor
                    </a>
                    <a href="{{ route('news-and-events.show') }}"
                        class="{{ Route::is('news-and-events.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        News & Events
                    </a>
                    <a href="{{ route('contact-us.show') }}"
                        class="{{ Route::is('contact-us.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                        Contact Us
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <button id="menu-btn2" class="text-gray-600 md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- <div class="hidden bg-gray-50 lg:flex">
        <div class="flex flex-row items-center w-full">
            <div class="flex items-center justify-center pr-[20rem] w-full gap-14 text-gray-800">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold lg:text-sm">24/7 Emergency Services</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold lg:text-sm">Specialized Doctors</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                    <span class="text-sm font-bold lg:text-sm">Patient-Centric Care</span>
                </div>
            </div>

            <div class="flex items-center py-3 pl-5 space-x-4 text-white bg-blue-600 rounded-l-lg shadow pr-[15rem]">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8">
                    <path fill="currentColor"
                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                </svg>
                <span class="text-xl font-bold sm:text-2xl text-nowrap">0917 327 7463</span>
            </div>
        </div>
    </div> --}}

    <!-- Mobile Nav -->
    <div id="menu2" class="flex-col hidden px-6 pb-4 space-y-2 md:hidden bg-gray-50">
        <div>
            <a href="{{ route('home') }}"
                class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Home </a>
            <a href="{{ route('about-us') }}"
                class="{{ Route::is('about-us') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                About Us </a>
            <a href="{{ route('services') }}"
                class="{{ Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Services </a>
            <a href="{{ route('careers') }}"
                class="{{ Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Careers </a>
            <a href="#"
                class="{{ Route::is('#') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Find a Doctor </a>
            <a href="#"
                class="{{ Route::is('#') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                New & Events </a>
            <a href="#"
                class="{{ Route::is('#') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Contact Us</a>
        </div>

        <!-- Features + Hotline -->
        <div class="bg-gray-50">
            <div
                class="container flex flex-col items-center justify-between px-6 mx-auto space-y-4 lg:flex-row lg:space-y-0">
                <div class="flex items-center justify-center gap-6 text-gray-800">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-xl">24/7 Emergency Services</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-xl">Specialized Doctors</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-xl">Patient-Centric Care</span>
                    </div>
                </div>

                <div
                    class="flex items-center w-full max-w-xs px-5 py-3 space-x-4 text-white bg-blue-600 rounded-lg shadow sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8">
                        <path fill="currentColor"
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                    </svg>
                    <span class="text-xl font-bold sm:text-2xl">0917 327 7463</span>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Animation for slide down */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-slide-down {
        animation: slideDown 0.3s ease-out;
    }
</style>

<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    const btn2 = document.getElementById('menu-btn2');
    const menu2 = document.getElementById('menu2');
    btn2.addEventListener('click', () => {
        menu2.classList.toggle('hidden');
    });

    document.addEventListener('DOMContentLoaded', () => {
        const header = document.getElementById('header');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.remove('-translate-y-full', 'opacity-0');
                header.classList.add('translate-y-0', 'opacity-100');
            } else {
                header.classList.remove('translate-y-0', 'opacity-100');
                header.classList.add('-translate-y-full', 'opacity-0');
            }
        });
    });
</script>
