<footer class="relative bg-white border-t border-gray-200">
    <img src="{{ asset('assets/footer-bg.png') }}" alt="" class="w-full">
    <div class="container absolute inset-0 mx-auto mt-16">
        <div class="flex flex-col justify-between h-full py-10">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">

                <!-- Logo + Emergency Info -->
                <div class="grid grid-cols-1 gap-2">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="mb-4">
                    <h3 class="text-4xl font-semibold text-[#0035c6] pattaya-regular">Emergency Contact Information
                    </h3>
                    <p class="mt-2 text-lg text-black">Emergency Hotline:</p>
                    <p class="text-4xl font-bold text-[#0035c6]">0917 32PRIME</p>
                    <p class="mt-2 text-lg text-black">Ambulance Service:</p>
                    <p class="text-4xl font-bold text-[#0035c6]">0917 32PRIME</p>
                    <p class="mt-2 text-lg text-black">Email for Inquiries:</p>
                    <a href="mailto:dummyhospital@gmail.com"
                        class="font-semibold text-[#0035c6]">primedoctorsmedicalcenter@gmail.com</a>
                </div>

                <!-- Quick Links -->
                <div class="grid grid-cols-1 gap-3 h-fit">
                    <h3 class="text-4xl font-semibold text-[#0035c6] pattaya-regular">Quick Links</h3>
                    <ul class="grid grid-cols-1 gap-4 mt-3 text-lg text-black">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
                        <li><a href="{{ route('about-us') }}" class="hover:text-blue-600">About Us</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-blue-600">Services</a></li>
                        <li><a href="{{ route('careers') }}" class="hover:text-blue-600">Careers</a></li>
                        <li><a href="#" class="hover:text-blue-600">Find A Doctor</a></li>
                        <li><a href="#" class="hover:text-blue-600">News & Events</a></li>
                        <li><a href="#" class="hover:text-blue-600">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Patient Support -->
                <div class="grid grid-cols-1">
                    <div class="grid grid-cols-1 gap-3 h-fit">
                        <h3 class="text-4xl font-semibold text-[#0035c6] pattaya-regular">Patient Support</h3>
                        <ul class="mt-2 space-y-2 text-lg text-black">
                            <li><a href="#" class="hover:text-blue-600">Patient Rights & Responsibilities</a></li>
                            <li><a href="#" class="hover:text-blue-600">Billing & Insurance</a></li>
                            <li><a href="#" class="hover:text-blue-600">Preparing for Your Visit</a></li>
                            <li><a href="#" class="hover:text-blue-600">Accessibility Services</a></li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-1 gap-2 h-fit">
                        <div class="text-4xl pattaya-regular text-[#0035c6]">Follow Our Socials</div>
                        <div class="flex gap-2">
                            <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24"
                                    class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f] bg-white">
                                    <path fill="currentColor"
                                        d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22 22 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202z" />
                                </svg>
                            </a>
                            <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -0 24 24"
                                    class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f] bg-white">
                                    <path fill="currentColor"
                                        d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
                                </svg>
                            </a>
                            <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -0 25 25"
                                    class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f] bg-white">
                                    <rect width="24" height="24" fill="none" />
                                    <path fill="currentColor"
                                        d="M6.94 5a2 2 0 1 1-4-.002a2 2 0 0 1 4 .002M7 8.48H3V21h4zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91z"
                                        stroke-width="0.5" stroke="currentColor" />
                                </svg>
                            </a>
                            <a href="#" class="transition duration-300 cursor pointer hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0 -0 24 24"
                                    class="h-10 p-1 border-[6px] rounded-full border-[#edb42f] text-[#edb42f] bg-white">
                                    <rect width="24" height="24" fill="none" />
                                    <path fill="currentColor"
                                        d="m10 15l5.19-3L10 9zm11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73"
                                        stroke-width="0.5" stroke="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="grid grid-cols-1 gap-10 h-fit">
                    <div class="grid grid-cols-1 gap-2">
                        <h3 class="text-4xl font-semibold text-[#0035c6] pattaya-regular">Hospital Location and
                            Directions
                        </h3>
                        <p class="mt-2 text-lg text-black">Address: <span class="font-bold">Antipolo del Sur, Lipa City,
                                Philippines</span></p>
                        <div class="mt-4">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15491.0731156302!2d121.180940712519!3d13.912794212211033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd14b655ac04d1%3A0x2e624e7df1163e5!2sAntipolo%20Del%20Sur%2C%20Lipa%20City%2C%20Batangas!5e0!3m2!1sen!2sph!4v1757298473876!5m2!1sen!2sph"
                                style="border:0;" allowfullscreen="" loading="lazy" class="w-full"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="text-4xl font-semibold text-[#0035c6] pattaya-regular">
                            Newsletter
                        </div>

                        <form action="{{ route('newsletter.store') }}" method="POST"
                            class="flex items-center w-full max-w-md px-1 py-2 bg-gray-100 rounded-full shadow">
                            @csrf

                            <!-- Email Input -->
                            <input type="email" name="email" placeholder="Email Address"
                                class="flex-grow w-full px-4 py-3 text-gray-700 bg-transparent focus:outline-none"
                                required>

                            <!-- Subscribe Button -->
                            <button type="submit"
                                class="relative flex items-center gap-3 transition duration-300 rounded-full bg-[#edb42f] py-auto hover:scale-105 hover:shadow-lg">
                                <span class="font-semibold text-white ml-7">SUBSCRIBE</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-12 text-white">
                                    <g fill="none" stroke="currentColor" stroke-width="1">
                                        <circle cx="12" cy="12" r="10" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                    </g>
                                </svg>
                            </button>
                        </form>

                        <!-- Validation Errors -->
                        @error('email')
                            <p class="mt-2 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- Bottom -->
            <div
                class="flex flex-col items-center justify-between pt-4 mt-8 text-lg text-black border-t border-gray-200 md:flex-row">
                <p class="font-bold">© 2025 Dummy Hospital. <span class="font-normal">Designed & Developed by</span>
                    <a href="https://rwebsolutions.com.ph/" class="font-semibold underline text-[#edb42f]">R
                        Web
                        Solutions Corp</a>.
                </p>
                <div class="flex mt-4 space-x-4 md:mt-0">
                    <a href="#" class="text-[#edb42f] hover:underline">Privacy Policy</a>
                    <div>
                        |
                    </div>
                    <a href="#" class="text-[#edb42f] hover:underline">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Subscribed!',
            text: "{{ session('success') }}",
            timer: 2500,
            showConfirmButton: false
        });
    </script>
@endif
