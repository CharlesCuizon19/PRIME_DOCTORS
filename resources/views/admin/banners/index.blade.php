@extends('admin.layouts.adminapp')

@section('title', 'Homepage Banner')

@section('admin-content')
    <!-- Page Title -->
    <h1 class="text-2xl font-semibold mb-6">HOMEPAGE BANNER</h1>

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-6">
        <!-- Create Button -->
        <a href="{{ route('admin.banners.create') }}"
            class="ml-auto inline-flex items-center gap-2 text-lg bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

            <!-- Plus Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Create Banner
        </a>
    </div>


    <!-- Table -->
    <div class="overflow-x-auto bg-white border rounded-lg shadow">
        <table id="users-table" class="min-w-full text-lg text-gray-700">
            <thead class="bg-black text-white">
                <tr>
                    <th class="px-6 py-3 text-center w-20">ID</th>
                    <th class="px-6 py-3 text-center w-1/5">Title</th>
                    <!-- <th class="px-6 py-3 text-center w-1/5">Context</th> -->
                    <th class="px-6 py-3 text-center w-1/5">Banner</th>
                    <th class="px-6 py-3 text-center w-1/6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-center">{{ $banner->id }}</td>
                        <td class="px-6 py-3 text-center">{{ $banner->title }}</td>
                        <!-- <td class="px-6 py-3 text-center">{{ strip_tags($banner->context) }}</td> -->

                        <td class="px-6 py-3 text-center">
                            @if ($banner->image && $banner->image->file && $banner->image->file->image_path)
                                <img src="{{ asset($banner->image->file->image_path) }}"
                                    alt="{{ $banner->image->alt_text ?? 'Banner' }}"
                                    class="mx-auto w-24 h-12 object-cover rounded shadow">
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>


                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                    class="px-3 py-1 rounded text-white bg-blue-500 hover:bg-blue-600">Edit</a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="delete-btn px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
@push('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                ordering: false
            });

            // ✅ SweetAlert Delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "This banner will be permanently deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endpush
