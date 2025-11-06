@props([
'career_name' => '',
'career_id' => null,
])

<div x-data="careerForm('{{ $career_id }}')" x-effect="document.body.classList.toggle('overflow-hidden', open)" class="relative z-50">
    <!-- Button -->
    <button @click="open = true">
        <div class="flex items-center gap-5 px-1 py-1 text-white transition duration-300 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
            <span class="ml-5 mr-5 text-base font-semibold text-nowrap">APPLY NOW</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 lg:h-14">
                <g fill="none" stroke="currentColor" stroke-width="1">
                    <circle cx="12" cy="12" r="10" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                </g>
            </svg>
        </div>
    </button>

    <!-- Modal -->
    <template x-teleport="body">
        <div x-show="open" x-transition.opacity x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4" aria-modal="true">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>

            <!-- Modal Box -->
            <div @click.stop x-transition.scale.origin.center
                class="relative z-10 w-full p-5 max-w-xl h-fit max-h-[90%] overflow-y-auto bg-white text-gray-900 border border-gray-300 rounded-xl shadow-2xl isolate">

                <!-- Header -->
                <div class="sticky top-0 flex items-center justify-between py-4 mb-5 bg-white border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-[#002984]">Apply for this position</h2>
                    <button @click="open = false"
                        class="px-[7px] py-[2px] text-base leading-none text-white bg-red-600 rounded-full hover:bg-red-700">
                        ✕
                    </button>
                </div>

                <!-- Form -->
                <form action="{{ route('career_application.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="career_id" :value="career_id">

                    <!-- Job Position -->
                    <div class="mb-6">
                        <p class="font-semibold text-[#002984] text-lg mb-2">Job Position</p>
                        <div class="p-3 border border-[#a5c4ff] bg-[#e8f0ff] text-[#002984] rounded-full">
                            {{ $career_name }}
                        </div>
                    </div>

                    <!-- General Information -->
                    <div class="mb-6">
                        <p class="font-semibold text-[#002984] text-lg mb-3">General Information</p>
                        <div class="grid grid-cols-1 gap-3 mb-3 sm:grid-cols-2">
                            <input type="text" name="applicant_first_name" placeholder="First Name" required
                                class="border border-gray-300 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-[#002984]">
                            <input type="text" name="applicant_last_name" placeholder="Last Name" required
                                class="border border-gray-300 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-[#002984]">
                        </div>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <input type="email" name="applicant_email" placeholder="Email Address" required
                                class="border border-gray-300 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-[#002984]">
                            <input type="text" name="applicant_phone" placeholder="Phone No." required
                                class="border border-gray-300 rounded-full px-4 py-2 w-full focus:outline-none focus:ring-1 focus:ring-[#002984]">
                        </div>
                    </div>

                    <!-- Upload Resume -->
                    <div class="mb-6" x-data>
                        <p class="font-semibold text-[#002984] text-lg mb-3">Upload Resume/CV</p>
                        <div class="flex flex-col items-center justify-center py-8 text-center border-2 border-gray-300 border-dashed rounded-xl">
                            <div class="text-4xl mb-2 text-[#002984]">📄</div>
                            <p class="mb-3 text-lg text-gray-500">Click button below or drag file to upload (max 2MB)</p>

                            <label class="bg-[#002984] hover:bg-[#0046ff] text-white px-4 py-2 rounded-md text-lg cursor-pointer flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                                Upload File
                                <input type="file" name="resume" accept=".pdf,.doc,.docx" class="hidden" required @change="previewFile($event)">
                            </label>

                            <!-- File Preview -->
                            <template x-if="fileName">
                                <div class="mt-5 w-full">
                                    <p class="text-gray-700 font-medium mb-2">Selected File:</p>
                                    <p class="text-sm text-gray-600 mb-3" x-text="fileName"></p>

                                    <template x-if="isPDF">
                                        <iframe :src="fileURL" class="w-full h-64 border rounded-md"></iframe>
                                    </template>

                                    <template x-if="!isPDF">
                                        <div class="flex items-center justify-center gap-2 text-[#002984] text-lg font-semibold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4h16v16H4z" />
                                            </svg>
                                            <span x-text="fileName"></span>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- ✅ Google reCAPTCHA --}}
                    <div class="mb-6">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITEKEY') }}"></div>
                        @error('g-recaptcha-response')
                        <p class="mt-2 text-lg text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col justify-between gap-3 sm:flex-row">
                        <button @click="open = false" type="button"
                            class="flex items-center gap-3 px-4 py-2 text-white transition duration-300 rounded-full shadow bg-[#838383] hover:scale-105 hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="rotate-180 h-7 lg:h-8">
                                <g fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                </g>
                            </svg>
                            <span class="pr-3 text-base font-semibold text-nowrap">BACK TO CAREERS</span>
                        </button>

                        <button type="submit"
                            class="flex items-center gap-3 px-4 py-2 text-white transition duration-300 rounded-full shadow bg-[#0035c6] hover:scale-105 hover:shadow-lg">
                            <span class="ml-3 mr-3 text-base font-semibold text-nowrap">SUBMIT APPLICATION</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="h-7 lg:h-8">
                                <g fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                </g>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function careerForm(careerId) {
        return {
            open: false,
            career_id: careerId,
            fileName: '',
            fileURL: '',
            isPDF: false,

            previewFile(event) {
                const file = event.target.files[0];
                if (!file) return;

                this.fileName = file.name;
                this.isPDF = file.type === 'application/pdf';
                this.fileURL = this.isPDF ? URL.createObjectURL(file) : '';
            }
        }
    }
</script>