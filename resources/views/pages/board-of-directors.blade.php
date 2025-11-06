@extends('layouts.app')

@section('title', 'Board of Directors')

@php
    $directors = [
        (object) [
            'name' => 'Dr. Antonio Ramirez',
            'position' => 'President',
            'background' => 'Dr. Antonio Ramirez stands as the driving force and founding visionary of Prime Doctors Medical Center. With over 25 years of experience in internal medicine, hospital management, and healthcare innovation, he has transformed the institution from a modest community clinic into one of the most trusted multi-specialty medical centers in the region. His leadership philosophy is grounded in compassion, quality, and integrity. Dr. Ramirez believes that accessible healthcare should never compromise excellence. Under his direction, Prime Doctors Medical Center has expanded its range of services — from general consultation to advanced diagnostics and specialty care — ensuring that patients receive comprehensive treatment under one roof.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.',
        ],
        (object) [
            'name' => 'Dr. Maria Luisa Fernandez',
            'position' => 'Vice President',
            'background' =>
                'Dr. Maria Luisa Fernandez has been instrumental in developing programs that ensure the hospital maintains the highest standard of care. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at luctus massa, nec vulputate augue.',
        ],
        (object) [
            'name' => 'Mr. Robert Tan',
            'position' => 'Chief Executive Officer (CEO)',
            'background' =>
                'Mr. Robert Tan oversees all executive and administrative operations of the hospital. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porta tincidunt lorem, non condimentum erat.',
        ],
        (object) [
            'name' => 'Dr. Isabella Cruz',
            'position' => 'Medical Director',
            'background' =>
                'Dr. Isabella Cruz manages the hospital’s medical departments and ensures quality assurance in all health services. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in sapien ac odio viverra cursus.',
        ],
        (object) [
            'name' => 'Dr. Gabriel Torres',
            'position' => 'Chief of Surgery',
            'background' =>
                'Dr. Gabriel Torres leads the surgical department and coordinates interdisciplinary surgical teams. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus.',
        ],
        (object) [
            'name' => 'Dr. Hannah Lim',
            'position' => 'Chief of Internal Medicine',
            'background' =>
                'Dr. Hannah Lim is a leading figure in the hospital’s internal medicine department. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel odio nec velit facilisis fermentum.',
        ],
        (object) [
            'name' => 'Dr. Vincent Dela Peña',
            'position' => 'Chief of Emergency Services',
            'background' =>
                'Dr. Vincent Dela Peña oversees emergency and trauma response units, ensuring rapid and coordinated care. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo nisl eu ipsum tincidunt dignissim.',
        ],
        (object) [
            'name' => 'Engr. Melissa Santos',
            'position' => 'Director of Facilities & Technology',
            'background' =>
                'Engr. Melissa Santos supervises the hospital’s infrastructure and technological systems. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec ligula in sapien suscipit vehicula.',
        ],
    ];
@endphp


@section('content')
    <div class="flex flex-col overflow-x-hidden">
        <x-banner title1="Board of" title2="Directors" img_path='assets/about-us-banner.png' page="Board of Directors"
            breadcrumb="" />

        <div class="container flex flex-col gap-16 py-20 mx-auto">
            <div class="flex flex-col items-center justify-center gap-5">
                <span class="px-6 py-2 text-lg font-semibold bg-gray-100 rounded-full text-[#0035c6]">Who We
                    Are</span>
                <div class="w-[35%] text-center text-4xl font-semibold leading-snug">
                    Leading with Vision, Integrity, and Compassion
                </div>
            </div>

            <div class="grid grid-cols-2 gap-5 lg:grid-cols-4 ">
                @foreach ($directors as $item)
                    <x-BOD-modal name="{{ $item->name }}" position="{{ $item->position }}"
                        background="{{ $item->background }}" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
