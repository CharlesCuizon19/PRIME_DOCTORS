@extends('layouts.app')

@section('title', 'Bridging Health Through Care')

@section('content')
    <div>
        @include('homepage-tabs.banner-tab')

        {{-- OUR SERVICES --}}
        @include('homepage-tabs.our-services-tab')

        {{-- ABOUT US --}}
        @include('homepage-tabs.about-us-tab')

        {{-- OUR DOCTOR --}}
        @include('homepage-tabs.our-doctors-tab')

        {{-- FAQ --}}
        @include('homepage-tabs.FAQ-tab')

        {{-- NEWS & EVENTS --}}
        @include('homepage-tabs.news&events-tab')

        {{-- GET CONSULTATION DESKTOP --}}
        @include('homepage-tabs.get-consultation-tab')
    @endsection
