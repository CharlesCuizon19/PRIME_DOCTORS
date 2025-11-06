@extends('admin.layouts.adminapp')

@section('title', 'Dashboard')

@section('admin-content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-3xl text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to the Admin Dashboard</h1>
        <p class="text-gray-600 mb-6">You are now logged in as an administrator.</p>
    </div>
</div>
@endsection