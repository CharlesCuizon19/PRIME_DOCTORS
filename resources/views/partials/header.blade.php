<header x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)"
    :class="scrolled
        ?
        'fixed top-0 left-0 w-full z-50 shadow-md transition-all duration-300 animate-slide-down' :
        'relative z-50 bg-transparent drop-shadow-md transition-all duration-300'">
    <div class="relative">
        <img src="{{ asset('assets/header-bg.png') }}" alt="" class="w-full h-[7rem] z-10">

        <div class="container absolute inset-0 top-0 z-50 flex items-center justify-between mx-auto">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-20 lg:h-20">
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden space-x-6 lg:flex">
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Home
                </a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-1 px-3 py-1 transition duration-300 rounded-full
        {{ Route::is('about-us') || Route::is('company-profile') || Route::is('BOD')
            ? 'bg-gray-200 text-blue-700 font-semibold border-2 border-[#edb42f]'
            : 'text-white hover:text-gray-500 hover:bg-white' }}">
                        About Us
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute left-0 z-50 w-48 mt-2 bg-white rounded-lg shadow-lg">
                        <a href="{{ route('about-us') }}"
                            class="block px-4 py-2 rounded-t-lg {{ Route::is('about-us') ? 'font-bold text-blue-700' : 'font-normal text-gray-700' }} hover:bg-gray-100">
                            Company Profile
                        </a>
                        <a href="{{ route('BOD') }}"
                            class="block px-4 py-2 rounded-t-lg {{ Route::is('BOD') ? 'font-bold text-blue-700' : 'font-normal text-gray-700' }} hover:bg-gray-100">
                            Board of Directors
                        </a>
                    </div>
                </div>
                <a href="{{ route('services') }}"
                    class="{{ Route::is('service.*') || Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">Services</a>
                <a href="{{ route('careers') }}"
                    class="{{ Route::is('careers.*') || Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">Careers</a>
                <a href="{{ route('find-a-doctor.show') }}"
                    class="{{ Route::is('find-a-doctor.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Find a Doctor
                </a>
                <a href="{{ route('news-and-events.show') }}"
                    class="{{ Route::is('news-and-events.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    News & Events
                </a>
                <a href="{{ route('contact-us.show') }}"
                    class="{{ Route::is('contact-us.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-white' }} px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                    Contact Us
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="menu-btn" class="text-gray-600 lg:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="menu" class="fixed flex-col hidden pb-4 space-y-2 md:hidden bg-gray-50">
        <div>
            <a href="{{ route('home') }}"
                class="{{ Route::is('home') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Home </a>
            <a href="{{ route('about-us') }}"
                class="{{ Route::is('about-us') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                About Us </a>
            <a href="{{ route('services') }}"
                class="{{ Route::is('service.*') || Route::is('services') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Services </a>
            <a href="{{ route('careers') }}"
                class="{{ Route::is('careers.*') || Route::is('careers') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Careers </a>
            <a href="{{ route('find-a-doctor.show') }}"
                class="{{ Route::is('find-a-doctor.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Find a Doctor </a>
            <a href="{{ route('news-and-events.show') }}"
                class="{{ Route::is('news-and-events.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                New & Events </a>
            <a href="{{ route('contact-us.show') }}"
                class="{{ Route::is('contact-us.*') ? 'bg-gray-200 rounded-full text-blue-700 font-semibold border-2 border-[#edb42f]' : ' text-gray-500' }}  block px-3 py-1 hover:text-gray-500 hover:bg-white rounded-full transition duration-300">
                Contact Us</a>
        </div>

        <!-- Features + Hotline -->
        <div class="bg-gray-50">
            <div
                class="container flex flex-col items-center justify-between mx-auto space-y-4 lg:flex-row lg:space-y-0">
                <div class="flex items-center justify-center text-gray-800 gap-14">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon1.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-lg">24/7 Emergency Services</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon2.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-lg">Specialized Doctors</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('assets/icon3.png') }}" class="w-6 h-6">
                        <span class="text-sm font-bold lg:text-lg">Patient-Centric Care</span>
                    </div>
                </div>

                <div
                    class="flex items-center w-full max-w-xs px-5 py-3 space-x-4 text-white bg-blue-600 rounded-lg shadow sm:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-8">
                        <path fill="currentColor"
                            d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" />
                    </svg>
                    <span class="text-sm font-bold lg:text-2xl">0917 327 7463</span>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>


<style>
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
