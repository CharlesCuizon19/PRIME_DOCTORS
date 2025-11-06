@extends('layouts.app')

@section('title', 'Service')

@section('content')
    <div class="flex flex-col">
        <x-banner title1="Our" title2="Services" img_path='assets/services-banner.png' page="Services /"
            breadcrumb="{!! $service->title !!}" />

        <div class="h-full py-20 bg-gray-100">
            <div class="container grid grid-cols-1 gap-12 px-4 py-12 mx-auto lg:px-8 lg:grid-cols-3">

                <!-- LEFT CONTENT -->
                <div class="space-y-12 lg:col-span-2">

                    <!-- Service Image -->
                    <div class="overflow-hidden rounded-3xl shadow-md">
                        <img src="{{ asset('storage/services/' . basename(optional($service->image)?->file?->image_path ?? '')) }}"
                            alt="{{ $service->title }} Image" class="object-cover w-full">
                    </div>

                    <!-- Description -->
                    <section>
                        <h2 class="mb-4 text-3xl font-bold text-[#0035c6] pattaya-regular">Description</h2>
                        <p class="leading-relaxed text-gray-700 text-justify">
                            {!! $service->description !!}
                        </p>
                    </section>

                    <!-- What's Included -->
                    @if ($service->inclusions && $service->inclusions->count() > 0)
                        <section>
                            <h3 class="mb-4 text-3xl font-bold text-[#0035c6] pattaya-regular">What's Included</h3>
                            <ul class="space-y-3 text-gray-700">
                                @foreach ($service->inclusions as $inclusion)
                                    <li class="flex items-start space-x-3">
                                        <div class="flex items-center justify-center w-6 h-6 bg-yellow-500 rounded-full">
                                            <span class="text-white text-lg font-bold">✔</span>
                                        </div>
                                        <span>{{ $inclusion->inclusion_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    <!-- Why It Matters -->
                    @if ($service->why_it_matters)
                        <section>
                            <h3 class="mb-4 text-3xl font-bold text-[#0035c6] pattaya-regular">Why It Matters</h3>
                            <p class="leading-relaxed text-gray-700 text-justify">
                                {!! $service->why_it_matters !!}
                            </p>
                        </section>
                    @endif

                    <!-- Benefits for Patients -->
                    @if ($service->benefits && $service->benefits->count() > 0)
                        <section>
                            <h3 class="mb-4 text-3xl font-bold text-[#0035c6] pattaya-regular">Benefits for Patients</h3>
                            <ul class="space-y-3 text-gray-700">
                                @foreach ($service->benefits as $benefit)
                                    <li class="flex items-start space-x-3">
                                        <img src="{{ asset('assets/benefits-icon.png') }}" alt=""
                                            class="w-6 h-6 mt-1">
                                        <span>{{ $benefit->benefit_name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                </div>

                <!-- RIGHT SIDEBAR -->
                <aside class="space-y-10">

                    <!-- Other Services -->
                    <div class="overflow-hidden rounded-3xl shadow-md bg-white">
                        <div class="p-5 text-lg font-semibold text-white bg-[#0035c6]">Other Services</div>
                        <ul class="p-6 space-y-3">
                            @foreach ($services as $item)
                                <li>
                                    <a href="{{ route('service.show', ['id' => $item->id]) }}"
                                        class="flex items-center justify-between text-gray-700 hover:text-[#0035c6] transition">
                                        <span>{{ $item->title }}</span>
                                        <span class="text-2xl text-gray-400">›</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Appointment Form -->
                    <div class="overflow-hidden rounded-3xl shadow-md bg-white">
                        <div class="p-5 text-lg font-semibold text-white bg-[#0035c6]">Book an Appointment</div>
                        <div class="p-6">
                            <div id="appointmentMessage"></div>

                            <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST"
                                class="space-y-4">
                                @csrf

                                <div>
                                    <select name="doctor_id"
                                        class="w-full px-5 py-3 pr-10 text-gray-700 border rounded-full appearance-none">
                                        <option value="">Select Doctor</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-lg text-red-600 error-message" data-field="doctor_id"></p>
                                </div>

                                <div>
                                    <input type="text" name="full_name" placeholder="Full Name"
                                        class="w-full px-5 py-3 border rounded-full">
                                    <p class="mt-1 text-lg text-red-600 error-message" data-field="full_name"></p>
                                </div>

                                <div>
                                    <input type="text" name="phone_number" placeholder="Phone No."
                                        class="w-full px-5 py-3 border rounded-full">
                                    <p class="mt-1 text-lg text-red-600 error-message" data-field="phone_number"></p>
                                </div>

                                <div>
                                    <input type="date" name="appointment_date"
                                        class="w-full px-5 py-3 border rounded-full">
                                    <p class="mt-1 text-lg text-red-600 error-message" data-field="appointment_date"></p>
                                </div>

                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 py-3 font-semibold text-white rounded-full shadow-md bg-[#edb42f] hover:bg-yellow-500 hover:scale-105 transition duration-300">
                                    BOOK YOUR APPOINTMENT
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                                        <path fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" d="M8 12h8m0 0l-3-3m3 3l-3 3" />
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </div>

                </aside>

            </div>
        </div>
    </div>

    <!-- AJAX Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('appointmentForm');
            const messageBox = document.getElementById('appointmentMessage');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                messageBox.innerHTML = '';

                // Clear previous inline errors
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        messageBox.innerHTML = `
                    <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
                        Your appointment has been booked successfully!
                    </div>
                `;
                        form.reset();
                        setTimeout(() => messageBox.innerHTML = '', 4000);
                    } else if (response.status === 422) {
                        const data = await response.json();
                        // Show per-field error messages
                        Object.keys(data.errors).forEach(field => {
                            const errorEl = document.querySelector(
                                `.error-message[data-field="${field}"]`);
                            if (errorEl) errorEl.textContent = data.errors[field][0];
                        });
                    } else {
                        messageBox.innerHTML = `
                    <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                        Something went wrong. Please try again.
                    </div>
                `;
                    }
                } catch (error) {
                    console.error(error);
                    messageBox.innerHTML = `
                <div class="p-4 mb-4 text-red-800 bg-red-100 rounded-lg">
                    Network error. Please try again.
                </div>
            `;
                }
            });
        });
    </script>
@endsection
