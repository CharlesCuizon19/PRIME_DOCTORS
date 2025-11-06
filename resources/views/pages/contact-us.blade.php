@extends('layouts.app')

@section('title', 'Find a Doctor')

@section('content')
    <div class="flex flex-col">
        <x-banner title1="Contact" title2="Us" img_path='assets/contact-us-banner.png' page="Contact Us" breadcrumb="" />

        <div class=" bg-gray-50">
            <div class="bg-[#f9f9fb] py-32 container mx-auto space-y-20">
                <div class="grid w-full grid-cols-1 gap-12 lg:grid-cols-2">
                    <!-- Left: Contact Info -->
                    <div>
                        <h2 class="text-3xl font-bold text-[#1d4ed8] mb-2 pattaya-regular" data-aos="zoom-in"
                            data-aos-duration="1000">Get in Touch</h2>
                        <p class="mb-8 text-gray-600" data-aos="zoom-in" data-aos-duration="1000">
                            Have questions, need assistance, or want to book an appointment? Our team at Prime Doctors
                            Medical
                            Center is here to help.
                        </p>

                        <!-- Image -->
                        <div class="mb-6" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('assets/contact-us-img.png') }}" alt="Doctor with patient"
                                class="object-cover w-full shadow-md rounded-2xl">
                        </div>

                        <!-- Contact Details -->
                        <div class="grid grid-cols-2 gap-5">
                            <div class="flex items-start gap-3" data-aos="zoom-in" data-aos-duration="1000">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-5 text-[#edb42f]">
                                    <path fill="currentColor"
                                        d="M16 2A11.013 11.013 0 0 0 5 13a10.9 10.9 0 0 0 2.216 6.6s.3.395.349.452L16 30l8.439-9.953c.044-.053.345-.447.345-.447l.001-.003A10.9 10.9 0 0 0 27 13A11.013 11.013 0 0 0 16 2m0 15a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4" />
                                    <circle cx="16" cy="13" r="4" fill="none" />
                                </svg>
                                <div class="flex flex-col gap-3">
                                    <p class="font-semibold text-[#1d4ed8]">Location</p>
                                    <p class="text-gray-600">Antipolo del Sur, Lipa City, Philippines</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3" data-aos="zoom-in" data-aos-duration="1000">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 text-[#edb42f]">
                                    <path fill="currentColor"
                                        d="m19.23 15.26l-2.54-.29a1.99 1.99 0 0 0-1.64.57l-1.84 1.84a15.05 15.05 0 0 1-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52a2 2 0 0 0-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07c.53 8.54 7.36 15.36 15.89 15.89c1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98"
                                        stroke-width="0.5" stroke="currentColor" />
                                </svg>
                                <div class="flex flex-col gap-3">
                                    <p class="font-semibold text-[#1d4ed8]">Phone</p>
                                    <p class="text-gray-600">+1 (368) 567 89 54<br>+236 (456) 896 22</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3" data-aos="zoom-in" data-aos-duration="1000">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 text-[#edb42f]">
                                    <path fill="currentColor"
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z"
                                        stroke-width="0.5" stroke="currentColor" />
                                </svg>
                                <div class="flex flex-col gap-3">
                                    <p class="font-semibold text-[#1d4ed8]">Email Address</p>
                                    <p class="text-gray-600">primedoctors@gmail.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3" data-aos="zoom-in" data-aos-duration="1000">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 text-[#edb42f]">
                                    <path fill="currentColor"
                                        d="M17 22q-1.25 0-2.125-.875T14 19q0-.15.075-.7L7.05 14.2q-.4.375-.925.588T5 15q-1.25 0-2.125-.875T2 12t.875-2.125T5 9q.6 0 1.125.213t.925.587l7.025-4.1q-.05-.175-.062-.337T14 5q0-1.25.875-2.125T17 2t2.125.875T20 5t-.875 2.125T17 8q-.6 0-1.125-.213T14.95 7.2l-7.025 4.1q.05.175.063.338T8 12t-.012.363t-.063.337l7.025 4.1q.4-.375.925-.587T17 16q1.25 0 2.125.875T20 19t-.875 2.125T17 22"
                                        stroke-width="0.5" stroke="currentColor" />
                                </svg>
                                <div class="flex flex-col gap-3">
                                    <p class="font-semibold text-[#1d4ed8]">Socials</p>
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
                        </div>
                    </div>

                    <!-- Right: Contact Form -->
                    <div class="p-8 bg-white shadow-md rounded-2xl h-fit" data-aos="zoom-in" data-aos-duration="1000">
                        <h3 class="text-3xl font-semibold text-[#1d4ed8] mb-6 pattaya-regular">Fill Up The Form</h3>

                        <form id="contactForm" action="{{ route('contacts.store') }}" method="POST"
                            class="flex flex-col justify-between gap-8">
                            @csrf
                            <div class="space-y-3">
                                <label class="block mb-1 font-medium text-[#1d4ed8]">Full Name</label>
                                <input type="text" name="full_name" placeholder="Enter your full name" required
                                    class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div class="space-y-3">
                                    <label class="block mb-1 font-medium text-[#1d4ed8]">Email Address</label>
                                    <input type="email" name="email" placeholder="Enter your email address" required
                                        class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="space-y-3">
                                    <label class="block mb-1 font-medium text-[#1d4ed8]">Phone No.</label>
                                    <input type="text" name="phone_num" placeholder="Enter your phone no." required
                                        maxlength="11" inputmode="numeric" pattern="[0-9]*"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                                        class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="block mb-1 font-medium text-[#1d4ed8]">Subject</label>
                                <select name="subject" required
                                    class="w-full p-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select a subject</option>
                                    <option value="appointment">Appointment</option>
                                    <option value="inquiry">General Inquiry</option>
                                    <option value="feedback">Feedback</option>
                                </select>
                            </div>

                            <div class="space-y-3">
                                <label class="block mb-1 font-medium text-[#1d4ed8]">Message</label>
                                <textarea name="message" rows="4" placeholder="Enter your message" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>

                            {{-- ✅ Google reCAPTCHA --}}
                            <div class="mb-6">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div>
                                @error('g-recaptcha-response')
                                    <p class="mt-2 text-lg text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button id="submitBtn" type="submit"
                                class="relative flex items-center gap-3 transition duration-300 rounded-full w-fit bg-[#1d4ed8] py-auto hover:scale-105 hover:shadow-lg px-6 py-3">
                                <span id="btnText" class="font-semibold text-white ml-1">SEND A MESSAGE</span>
                                <svg id="btnIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="h-10 text-white">
                                    <g fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                    </g>
                                </svg>
                                <svg id="btnSpinner" class="hidden animate-spin h-6 w-6 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Google Map -->
                <div class=" border-2 border-[#edb42f]" data-aos="zoom-in" data-aos-duration="1000">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4835.908790606117!2d121.17952178551498!3d13.913219458731916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd15862b71d085%3A0x670d9d43e1b48f14!2sPrime%20Doctors%20Ambulatory%20Care%20%26%20Diagnostic%20Clinic%20-%20Lipa%20City!5e1!3m2!1sen!2sph!4v1759822340781!5m2!1sen!2sph"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-[25rem]"></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ SWEETALERT + AJAX HANDLER --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("contactForm");
            const submitBtn = document.getElementById("submitBtn");
            const btnText = document.getElementById("btnText");
            const btnIcon = document.getElementById("btnIcon");
            const btnSpinner = document.getElementById("btnSpinner");

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                // Clear old errors
                form.querySelectorAll(".text-red-600").forEach(el => el.remove());
                form.querySelectorAll("input, textarea, select").forEach(el => el.classList.remove(
                    "ring-2", "ring-red-500"));

                const formData = new FormData(form);

                // Show spinner
                btnText.textContent = "Sending...";
                btnIcon.classList.add("hidden");
                btnSpinner.classList.remove("hidden");
                submitBtn.disabled = true;

                try {
                    const response = await fetch(form.action, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
                            "Accept": "application/json"
                        },
                        body: formData
                    });

                    if (response.status === 422) {
                        const data = await response.json();
                        const errors = data.errors;
                        Object.keys(errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add("ring-2", "ring-red-500");
                                const errorSpan = document.createElement("span");
                                errorSpan.className = "text-red-600 text-lg mt-2 block";
                                errorSpan.textContent = errors[field][0];
                                input.insertAdjacentElement("afterend", errorSpan);
                            }
                        });
                        return;
                    }

                    if (response.ok) {
                        form.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Message Sent!",
                            text: "Your message has been successfully sent.",
                            confirmButtonColor: "#1d4ed8",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            text: "Please try again later.",
                            confirmButtonColor: "#1d4ed8"
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Network Error",
                        text: "Unable to send message. Please check your internet connection.",
                        confirmButtonColor: "#1d4ed8"
                    });
                } finally {
                    btnText.textContent = "SEND A MESSAGE";
                    btnIcon.classList.remove("hidden");
                    btnSpinner.classList.add("hidden");
                    submitBtn.disabled = false;
                }
            });
        });
    </script>
@endsection
