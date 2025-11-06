@props([
    'career_name' => '',
    'name' => '',
    'position' => '',
    'background' => '',
    'doctorProfile' => 'assets/doctor-thumbnail2.png',
])



<div x-data="{ open: false }" x-effect="document.body.classList.toggle('overflow-hidden', open)" class="relative z-40">

    <div>
        <button @click = "open = true">
            <div
                class="w-full p-4 overflow-hidden text-center transition duration-300 bg-white border border-gray-200 group hover:shadow-md hover:border hover:border-blue-700 rounded-xl">
                <!-- Image -->
                <div class="overflow-hidden rounded-lg max-h-[17rem]">
                    <img src="{{ asset($doctorProfile) }}" alt="Profile Photo" class="object-cover w-full h-full">
                </div>

                <!-- Name and Title -->
                <div class="mt-4 text-start">
                    <h3 class="text-lg font-bold text-gray-900">{{ $name }}</h3>
                    <p class="font-semibold text-blue-700">{{ $position }}</p>
                </div>

                <!-- Link -->
                <div class="flex items-start mt-3">
                    <div class="text-[#edb42f] font-medium inline-flex items-center gap-1">
                        See Info
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4 transition duration-300 group-hover:translate-x-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </button>
    </div>

    <!-- ✅ Teleport the actual modal into body -->
    <template x-teleport="body">
        <div x-show="open" x-transition x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
            aria-modal="true">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/50" @click="open = false">
            </div>

            <!-- Modal box -->
            <div @click.stop x-transition.scale.origin.center
                class="relative z-10 w-full p-5 max-w-6xl h-fit max-h-[90%] overflow-y-auto bg-white text-gray-100 rounded-xl shadow-2xl">

                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <div class="flex items-center col-span-1">
                        <div class="overflow-hidden rounded-lg h-fit">
                            <img src="{{ asset($doctorProfile) }}" alt=""
                                class="object-contain w-full h-full rounded-lg">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col gap-2 pb-5 mb-5 border-b border-gray-400/50">
                            <div class="text-2xl font-bold text-black">
                                {{ $name }}
                            </div>
                            <div class="text-lg font-bold text-blue-700">
                                {!! $position !!}
                            </div>
                        </div>
                        <div class="max-h-[70%] overflow-auto text-lg text-black/80">
                            {!! $background !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
