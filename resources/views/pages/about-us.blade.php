@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="relative flex flex-col overflow-x-hidden">
        <x-banner title1="About" title2="Us" img_path='assets/about-us-banner.png' page="About Us" breadcrumb="" />

        <div>
            <div class="container grid grid-cols-1 gap-20 px-6 py-24 mx-auto border-b-2 lg:grid-cols-2">

                <!-- Left Side (Images + Connect With) -->
                <div class="flex flex-col space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ asset('assets/aboutus-page-img1.png') }}" alt="Dummy 1" class="rounded-lg shadow-md"
                            data-aos="zoom-in" data-aos-duration="1000">
                        <div class="flex flex-col mt-10 space-y-4" data-aos="zoom-in" data-aos-duration="1000">
                            <p class="text-black">Connect With <br>
                                <span class="font-bold text-[#0035c6]">Prime Doctors Medical Center</span>
                            </p>
                            <img src="{{ asset('assets/aboutus-page-img2.png') }}" alt="Dummy 2"
                                class="rounded-lg shadow-md" data-aos="zoom-in" data-aos-duration="1000">
                        </div>
                    </div>
                    <img src="{{ asset('assets/aboutus-page-img3.png') }}" alt="Dummy 3" class="rounded-lg shadow-md"
                        data-aos="zoom-in" data-aos-duration="1000">
                </div>

                <!-- Right Side (Text + Stats) -->
                <div class="flex flex-col justify-between mt-10">
                    <div data-aos="zoom-in" data-aos-duration="1000">
                        <span class="px-4 py-1 text-sm font-semibold bg-gray-100 rounded-full text-[#0035c6]">Who We
                            Are</span>
                        <h2 class="mt-4 text-2xl font-bold lg:text-3xl">
                            Trusted healthcare services for more than two decades
                        </h2>
                        <p class="mt-4 leading-relaxed text-gray-600">
                            For over two decades, we have been dedicated to delivering exceptional healthcare services,
                            combining compassion, expertise, and innovation to meet the needs of every patient we serve.
                        </p>
                    </div>

                    <!-- Stats Section -->
                    <div class="grid grid-cols-2 gap-6 text-left">
                        <div class="flex flex-col space-y-3" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('assets/aboutus-icon1.png') }}" alt="" class="w-10 h-auto">
                            <div class="flex items-center gap-2 text-2xl font-bold text-[#0035c6]">
                                <h3 class=" count" data-target="20" data-suffix="+"></h3>
                                <span class="font-bold">Years</span>
                            </div>
                            <p class="text-sm text-gray-600">A proud legacy of delivering trusted and compassionate
                                healthcare to our community.</p>
                        </div>
                        <div class="flex flex-col space-y-3" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('assets/aboutus-icon2.png') }}" alt="" class="w-10 h-auto">
                            <div class="flex items-center gap-2 text-2xl font-bold text-[#0035c6]">
                                <h3 class=" count" data-target="10000" data-suffix="+"></h3>
                                <span class="font-bold">Patients</span>
                            </div>
                            <p class="text-sm text-gray-600">Improving lives through personalized treatment and dedicated
                                medical attention.</p>
                        </div>
                        <div class="flex flex-col space-y-3" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('assets/aboutus-icon3.png') }}" alt="" class="w-10 h-auto">
                            <div class="flex items-center gap-2 text-2xl font-bold text-[#0035c6]">
                                <h3 class=" count" data-target="95" data-suffix="%"></h3>
                                <span class="font-bold">Satisfaction</span>
                            </div>
                            <p class="text-sm text-gray-600">Consistently earning high ratings for quality care and positive
                                health outcomes.</p>
                        </div>
                        <div class="flex flex-col space-y-3" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('assets/aboutus-icon4.png') }}" alt="" class="w-10 h-auto">
                            <div class="flex items-center gap-2 text-2xl font-bold text-[#0035c6]">
                                <h3 class=" count" data-target="50" data-suffix="+"></h3>
                                <span class="font-bold">Specialists</span>
                            </div>
                            <p class="text-sm text-gray-600">Offering a wide range of expertise to address diverse
                                healthcare needs.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container relative grid grid-cols-1 gap-24 px-6 pt-24 pb-64 mx-auto">
                <div class="flex items-center justify-center">
                    <span class="px-4 py-1 text-sm font-semibold bg-gray-100 rounded-full text-[#0035c6]" data-aos="zoom-in"
                        data-aos-duration="1000">
                        Our History
                    </span>
                </div>
                <img src="{{ asset('assets/logo.png') }}" alt=""
                    class="absolute w-auto h-36 -right-[16rem] opacity-40" data-aos="zoom-in" data-aos-duration="1000">
                <div class="mx-3 space-y-12 lg:mx-24">
                    <!-- Year 2002 -->
                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-4" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <div class="flex items-center space-x-2 md:col-span-1">
                            <span class="text-2xl text-yellow-500">●</span>
                            <h3 class="text-lg font-bold text-blue-900">Year 2002</h3>
                        </div>
                        <div class="leading-relaxed text-gray-600 md:col-span-3">
                            <p>
                                Prime Doctors Medical Center was founded with a single mission — to provide accessible and
                                quality healthcare services to the community. Starting as a small clinic, our goal was to
                                make reliable medical care available to every family.
                            </p>
                            <p class="mt-4">
                                In those early days, the clinic was staffed by only a handful of passionate doctors and
                                nurses who worked tirelessly to serve patients. Despite limited resources, the dedication
                                and compassion of the team laid the foundation for a trusted medical institution that people
                                could turn to with confidence.
                            </p>
                        </div>
                    </div>

                    <!-- Year 2012 -->
                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-4" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <div class="flex items-center space-x-2 md:col-span-1">
                            <span class="text-2xl text-yellow-500">●</span>
                            <h3 class="text-lg font-bold text-blue-900">Year 2012</h3>
                        </div>
                        <div class="leading-relaxed text-gray-600 md:col-span-3">
                            <p>
                                With the trust of our patients, we expanded into a full-service medical center. New
                                departments such as Pediatrics, Internal Medicine, and Emergency Care were established,
                                ensuring comprehensive healthcare under one roof.
                            </p>
                            <p class="mt-4">
                                This period also marked the arrival of more specialized doctors and modern facilities,
                                enabling us to serve a growing number of patients with diverse needs. Community outreach
                                programs were introduced, reinforcing our role not just as a healthcare provider but also as
                                a partner in promoting wellness and prevention.
                            </p>
                        </div>
                    </div>
                    <img src="{{ asset('assets/logo.png') }}" alt=""
                        class="absolute w-auto h-36 -left-[16rem] opacity-40" data-aos="zoom-in"
                        data-aos-duration="1000">

                    <!-- Present -->
                    <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-4" data-aos="zoom-in"
                        data-aos-duration="1000">
                        <div class="flex items-center space-x-2 md:col-span-1">
                            <span class="text-2xl text-yellow-500">●</span>
                            <h3 class="text-lg font-bold text-blue-900">Present</h3>
                        </div>
                        <div class="leading-relaxed text-gray-600 md:col-span-3">
                            <p>
                                To keep up with advancements in medicine, Prime Doctors Medical Center introduced
                                state-of-the-art diagnostic facilities, digital records, and specialized care units, making
                                healthcare more efficient and patient-centered.
                            </p>
                            <p class="mt-4">
                                Alongside these upgrades, we invested in training programs to ensure our medical staff
                                stayed up to date with global standards of care. The integration of new technologies not
                                only streamlined patient services but also enhanced the accuracy of diagnoses and treatment,
                                making our center a leading hub for modern healthcare in the region.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="relative pb-20 bg-gray-100">
                <div class="container grid items-center justify-center grid-cols-1 mx-auto">
                    <div class="absolute  justify-center items-center -top-[15%]">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 lg:ml-14">
                            <div class="relative" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="{{ asset('assets/mission.png') }}" alt="" class="rounded-2xl">
                                <div class="absolute inset-0 flex flex-col items-start gap-5 ml-10 text-white mt-14">
                                    <div class="text-4xl font-bold">
                                        Our Mission
                                    </div>
                                    <div class="w-[60%] text-[17px]">
                                        To provide exceptional and compassionate healthcare that empowers patients, fosters
                                        trust, and advances
                                        community well-being through innovation and dedication.
                                    </div>
                                </div>
                            </div>
                            <div class="relative" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="{{ asset('assets/vision.png') }}" alt="" class="rounded-2xl">
                                <div class="absolute inset-0 flex flex-col items-start gap-5 ml-10 text-white mt-14">
                                    <div class="text-4xl font-bold">
                                        Our Vision
                                    </div>
                                    <div class="w-[60%] text-[17px]">
                                        To be the most trusted medical center, renowned for
                                        transformative care, progressive medical expertise,
                                        and unwavering commitment to health and healing.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-20 pt-64 ">
                        <div class="flex flex-col items-center justify-center gap-5 mt-10">
                            <span class="px-4 py-1 text-sm font-semibold bg-white rounded-full text-[#0035c6]"
                                data-aos="zoom-in" data-aos-duration="1000">
                                Consult Now
                            </span>
                            <span class="text-xl font-semibold leading-loose lg:text-2xl" data-aos="zoom-in"
                                data-aos-duration="1000">
                                Quick and easy steps to get the care you need
                            </span>
                        </div>

                        <div class="grid grid-cols-2 text-center lg:grid-cols-4">

                            <!-- Card 1 -->
                            <div class="flex flex-col items-center space-y-4" data-aos="zoom-in"
                                data-aos-duration="1000">
                                <div
                                    class="relative flex items-center justify-center bg-white border rounded-full shadow h-28 w-28">
                                    <img src="{{ asset('assets/consultnow-icon1.png') }}" alt="icon"
                                        class="w-auto h-10 text-yellow-500">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 text-xs font-bold text-white rounded-full shadow bg-[#0035c6] -top-0 -right-0">
                                        1
                                    </span>
                                </div>
                                <p class="text-xl">Search Doctor</p>
                            </div>

                            <!-- Card 2 -->
                            <div class="flex flex-col items-center space-y-4" data-aos="zoom-in"
                                data-aos-duration="1000">
                                <div
                                    class="relative flex items-center justify-center bg-white border rounded-full shadow h-28 w-28">
                                    <img src="{{ asset('assets/consultnow-icon2.png') }}" alt="icon"
                                        class="w-10 h-10 text-yellow-500">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 text-xs font-bold text-white rounded-full shadow bg-[#0035c6] -top-0 -right-0">
                                        2
                                    </span>
                                </div>
                                <p class="text-xl">Check Doctor Profile</p>
                            </div>

                            <!-- Card 3 -->
                            <div class="flex flex-col items-center space-y-4" data-aos="zoom-in"
                                data-aos-duration="1000">
                                <div
                                    class="relative flex items-center justify-center bg-white border rounded-full shadow h-28 w-28">
                                    <img src="{{ asset('assets/consultnow-icon3.png') }}" alt="icon"
                                        class="w-10 h-10 text-yellow-500">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 text-xs font-bold text-white rounded-full shadow bg-[#0035c6] -top-0 -right-0">
                                        3
                                    </span>
                                </div>
                                <p class="text-xl">Doctor Appointment</p>
                            </div>

                            <!-- Card 4 -->
                            <div class="flex flex-col items-center space-y-4" data-aos="zoom-in"
                                data-aos-duration="1000">
                                <div
                                    class="relative flex items-center justify-center bg-white border rounded-full shadow h-28 w-28">
                                    <img src="{{ asset('assets/consultnow-icon4.png') }}" alt="icon"
                                        class="w-10 h-10 text-yellow-500">
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 text-xs font-bold text-white rounded-full shadow bg-[#0035c6] -top-0 -right-0">
                                        4
                                    </span>
                                </div>
                                <p class="text-xl">Get First Solution</p>
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-center mt-20" data-aos="zoom-in" data-aos-duration="1000">
                        <a href="{{ route('find-a-doctor.show') }}"
                            class="flex items-center gap-5 px-1 py-1 text-white transition duration-300 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
                            <span class="ml-10 mr-3 text-base">FIND A DOCTOR</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 lg:h-11">
                                <g fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes growLine {
            0% {
                height: 0;
            }

            100% {
                height: var(--target-height);
            }
        }

        .animate-line {
            height: 0;
            animation: growLine 1s ease-out forwards;
        }

        .delay-1 {
            animation-delay: 0s;
        }

        .delay-2 {
            animation-delay: 1s;
        }

        .delay-3 {
            animation-delay: 2s;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".count");

            const runCounter = (counter) => {
                const target = +counter.getAttribute("data-target");
                const suffix = counter.getAttribute("data-suffix") || "";
                const increment = target / 200; // adjust speed

                let count = 0;
                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.floor(count).toLocaleString() + suffix;
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target.toLocaleString() + suffix;
                    }
                };
                updateCount();
            };

            // Run when in viewport
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        runCounter(entry.target);
                        obs.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => observer.observe(counter));
        });
    </script>
@endsection
