@extends('admin.layouts.adminapp')

@section('title', 'Careers')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">CAREERS</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <!-- Create Button -->
    <a href="{{ route('admin.careers.create') }}"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <!-- Plus Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>

        Create Career
    </a>
</div>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg">
    <table id="careers-table" class="table-fixed w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 rounded-tl-lg text-center w-16">ID</th>
                <th class="px-10 py-3 w-1/4 text-center">Career Name</th>
                <th class="px-10 py-3 w-1/4 text-center">Overview</th>
                <th class="px-10 py-3 w-1/4 text-center">Job Type</th>
                <th class="px-10 py-3 w-1/4 text-center">Experience</th>
                <th class="px-10 py-3 w-1/4 text-center">Vacancy</th>
                <th class="px-10 py-3 w-1/4 text-center">Qualifications</th>
                <th class="px-10 py-3 w-1/4 text-center">Responsibilities</th>
                <th class="px-10 py-3 w-1/4 text-center">Image</th>
                <th class="px-10 py-3 rounded-tr-lg text-center whitespace-nowrap w-40">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($careers as $career)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $career->id }}</td>
                <td class="px-10 py-3 text-center">{{ $career->career_name }}</td>
                <td class="px-10 py-3 text-center">{!! $career->overview !!}</td>
                <td class="px-10 py-3 text-center">{{ $career->job_type }}</td>
                <td class="px-10 py-3 text-center">{{ $career->experience ?? '-' }}</td>
                <td class="px-10 py-3 text-center">{{ $career->vacancy ?? '-' }}</td>

                <td class="px-10 py-3 text-center">
                    @if($career->qualifications->isNotEmpty())
                    <ul class="list-disc list-inside">
                        @foreach($career->qualifications as $qualification)
                        <li>{{ $qualification->qualification }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span class="text-gray-400 italic">None</span>
                    @endif
                </td>

                <td class="px-10 py-3 text-center">
                    @if($career->responsibilities->isNotEmpty())
                    <ul class="list-disc list-inside">
                        @foreach($career->responsibilities as $responsibility)
                        <li>{{ $responsibility->responsibility }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span class="text-gray-400 italic">None</span>
                    @endif
                </td>

                {{-- Career Image --}}
                <td class="px-6 py-3 text-center">
                    @if ($career->image && $career->image->file && $career->image->file->image_path)
                    <img src="{{ asset('storage/careers/' . basename(optional($career->image)?->file?->image_path ?? '')) }}"
                        alt="{{ $career->title }} Image"
                        class="h-12 w-20 object-cover rounded shadow mx-auto">
                    @else
                    <span class="text-gray-400 italic">No Image</span>
                    @endif
                </td>

                {{-- Actions --}}
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="flex justify-center items-center gap-2">
                        <a href="{{ route('admin.careers.edit', $career->id) }}"
                            class="px-3 py-1 rounded text-white bg-blue-500 hover:bg-blue-600">
                            Edit
                        </a>

                        <button type="button"
                            onclick="confirmDelete({{ $career->id }})"
                            class="px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600">
                            Delete
                        </button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ✅ Initialize DataTable
    $(document).ready(function() {
        $('#careers-table').DataTable({
            ordering: false,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search careers..."
            }
        });
    });

    // ✅ SweetAlert Delete Confirmation
    function confirmDelete(careerId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this career? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST';
                form.action = "/admin/careers/" + careerId;

                let csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = "{{ csrf_token() }}";

                let method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

{{-- ✅ Show Success Toast --}}
@if(session('success'))
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