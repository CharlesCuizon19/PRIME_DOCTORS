<div class="fixed inset-y-0 left-0 w-64 text-white bg-[#004AAD] flex flex-col">
    <!-- Logo -->
    <div class="flex items-center justify-center h-auto gap-5 py-3 border-b border-white/20">
        <img src="{{ asset('assets/logo.png') }}" alt="Prime Doctors Logo" class="w-10 h-10">
    </div>

    <!-- Scrollable Navigation -->
    <nav class="flex-1 overflow-y-auto mt-6 scrollbar-hide">
        <ul class="px-3 space-y-10">
            <div class="space-y-2">
                <li>
                    <a href="{{ route('admin.banners.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.banners.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Homepage Banners
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.blogs.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.blogs.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        News & Events
                    </a>
                </li>

                <!-- Offerings -->
                <li x-data="{ open: true }" class="space-y-1">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full py-2 pr-6 rounded-xl hover:bg-blue-800">
                        <span class="flex items-center gap-2 pl-2 pr-6">
                            <i class="ic--baseline-home-repair-service"></i>
                            <span>Offerings</span>
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-4 h-4 transform transition-transform duration-200"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="open" x-collapse class="pl-8 mt-2 space-y-1">
                        <li>
                            <a href="{{ route('admin.services.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.services.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.benefits.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.benefits.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Benefits
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.inclusions.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.inclusions.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Inclusions
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Talent Management -->
                <li x-data="{ open: true }" class="space-y-1">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full py-2 pr-6 rounded-xl hover:bg-blue-800">
                        <span class="flex items-center gap-2 pl-2 pr-6">
                            <i class="ic--baseline-work"></i>
                            <span>Talent Management</span>
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-4 h-4 transform transition-transform duration-200"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="open" x-collapse class="pl-8 mt-2 space-y-1">
                        <li>
                            <a href="{{ route('admin.careers.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.careers.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Careers
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.qualifications.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.qualifications.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Qualifications
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.responsibilities.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.responsibilities.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Responsibilities
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Doctor Management -->
                <li x-data="{ open: true }" class="space-y-1">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full py-2 pr-6 rounded-xl hover:bg-blue-800">
                        <span class="flex items-center gap-2 pl-2 pr-6">
                            <i class="ic--baseline-person"></i>
                            <span>Doctor Management</span>
                        </span>
                        <svg :class="{ 'rotate-180': open }"
                            class="w-4 h-4 transform transition-transform duration-200"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <ul x-show="open" x-collapse class="pl-8 mt-2 space-y-1">
                        <li>
                            <a href="{{ route('admin.doctors.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.doctors.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Doctors
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.specialization.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.specializations.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Specializations
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.languages.index') }}"
                                class="block py-2 pl-4 pr-6
                                {{ Route::is('admin.languages.*') ? 'bg-white text-black' : 'text-white' }}
                                hover:bg-gray-200 rounded-xl hover:text-black">
                                Languages
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.newsletters.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.newsletters.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Newsletter
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.contacts.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Contacts
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.appointments.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.appointments.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Appointment
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.consultations.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.consultations.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Consultations
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.career_applications.index') }}"
                        class="block py-2 pl-4 pr-6
                        {{ Route::is('admin.career_applications.*') ? 'bg-white text-black' : 'text-white' }}
                        hover:bg-gray-200 rounded-xl hover:text-black">
                        Applicants
                    </a>
                </li>
            </div>
        </ul>
    </nav>

    <!-- Logout Button (Always visible) -->
    <form action="{{ route('logout') }}" method="POST" class="p-4 border-t border-white/20">
        @csrf
        <button type="submit"
            class="w-full px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 transition">
            Logout
        </button>
    </form>
</div>