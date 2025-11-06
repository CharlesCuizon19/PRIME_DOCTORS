{{-- DESKTOP FORM --}}
<div class="hidden lg:pb-20 lg:flex" data-aos="zoom-in" data-aos-duration="1000">
    <div class="container relative mx-auto lg:rounded-[3rem] lg:w-fit lg:h-fit bg-[#edb42f]">
        <div class="flex items-center justify-center">
            <img src="{{ asset('assets/rectangle.png') }}" alt="">
        </div>
        <div class="absolute inset-0 flex flex-col gap-8 p-20">
            <div class="text-5xl text-[#0035c6] pattaya-regular">
                Get Consultation
            </div>
            <div class="w-1/2">
                <div class="text-xl font-light text-[#0035c6] w-fit">
                    It’s quick and easy—submit your details, and we’ll get back to you shortly.
                </div>
            </div>

            {{-- ✅ AJAX DESKTOP FORM --}}
            <form id="consultationFormDesktop" action="{{ route('consultations.store') }}" method="POST"
                class="flex flex-col md:flex-row md:items-start gap-6 flex-wrap">
                @csrf

                {{-- Name --}}
                <div class="flex flex-col w-full md:w-auto">
                    <input type="text" name="name" placeholder="Your Name*" required
                        class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-[#0035c6]
                               placeholder:opacity-50 focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                </div>

                {{-- Email --}}
                <div class="flex flex-col w-full md:w-auto">
                    <input type="email" name="email" placeholder="Your Email*" required
                        class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-[#0035c6]
                               placeholder:opacity-50 focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                </div>

                {{-- Contact Number --}}
                <div class="flex flex-col w-full md:w-auto">
                    <input type="text" name="contact_num" placeholder="Your Contact Number*" required
                        maxlength="11" inputmode="numeric" pattern="[0-9]*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                        class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-[#0035c6]
                               placeholder:opacity-50 focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                    class="flex items-center gap-3 transition duration-300 bg-white rounded-full py-3 px-6
                           hover:scale-105 hover:shadow-lg">
                    <span class="font-semibold ml-4 text-[#0035c6]">SUBMIT CONSULTANCY</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-10 text-[#0035c6]">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                        </g>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- MOBILE FORM --}}
<div class="flex lg:py-20 lg:hidden" data-aos="zoom-in" data-aos-duration="1000">
    <div class="bg-no-repeat bg-cover bg-[#edb42f]"
        style="background-image: url({{ asset('assets/rectangle2.png') }})">
        <div class="flex flex-col gap-8 px-3 py-10">
            <div class="text-2xl text-white pattaya-regular">
                Get Consultation
            </div>
            <div>
                <div class="text-sm font-light text-white w-fit">
                    It’s quick and easy—submit your details, and we’ll get back to you shortly.
                </div>
            </div>

            {{-- ✅ AJAX MOBILE FORM --}}
            <form id="consultationFormMobile" action="{{ route('consultations.store') }}" method="POST"
                class="flex flex-col gap-10">
                @csrf
                <input type="text" name="name" placeholder="Your Name*" required
                    class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-white
                           focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                <input type="email" name="email" placeholder="Your Email*" required
                    class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-white
                           focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                <input type="text" name="contact_num" placeholder="Your Contact Number*" required
                    maxlength="11" inputmode="numeric" pattern="[0-9]*"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                    class="px-10 py-4 rounded-full bg-[#f7e0ab] placeholder-white
                           focus:outline-none focus:ring-2 focus:ring-[#edb42f]">
                <button type="submit"
                    class="flex items-center gap-3 transition duration-300 bg-white rounded-full w-fit py-auto
                           hover:scale-105 hover:shadow-lg">
                    <span class="text-base font-semibold ml-7 text-[#edb42f]">SUBMIT CONSULTANCY</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="h-12 text-[#edb42f]">
                        <g fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                        </g>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ✅ AJAX HANDLER + SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const handleSubmit = (formId) => {
            const form = document.getElementById(formId);
            if (!form) return;

            form.addEventListener("submit", async function(e) {
                e.preventDefault();

                // Remove old errors
                form.querySelectorAll(".text-red-600").forEach(el => el.remove());
                form.querySelectorAll("input").forEach(el => el.classList.remove("ring-2", "ring-red-500"));

                const formData = new FormData(form);

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

                        for (const [field, messages] of Object.entries(errors)) {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add("ring-2", "ring-red-500");
                                const errorMsg = document.createElement("span");
                                errorMsg.className = "text-red-600 text-sm mt-2";
                                errorMsg.textContent = messages[0];
                                input.insertAdjacentElement("afterend", errorMsg);
                            }
                        }
                        return;
                    }

                    if (response.ok) {
                        form.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Your consultation has been submitted successfully!",
                            confirmButtonColor: "#0035c6",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Something went wrong. Please try again later.",
                        confirmButtonColor: "#0035c6"
                    });
                }
            });
        };

        handleSubmit("consultationFormDesktop");
        handleSubmit("consultationFormMobile");
    });
</script>