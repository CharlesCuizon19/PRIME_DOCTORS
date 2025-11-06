@extends('admin.layouts.adminapp')

@section('title', 'Career Applications')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">CAREER APPLICATIONS</h1>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg shadow">
    <table id="applications-table" class="min-w-full text-sm text-gray-700">
        <thead class="bg-black text-white">
            <tr>
                <th class="px-6 py-3 text-center w-20">ID</th>
                <th class="px-6 py-3 text-center w-1/5">Applicant Name</th>
                <th class="px-6 py-3 text-center w-1/5">Email</th>
                <th class="px-6 py-3 text-center w-1/5">Phone</th>
                <th class="px-6 py-3 text-center w-1/5">Career</th>
                <th class="px-6 py-3 text-center w-1/5">Resume</th>
                <th class="px-6 py-3 text-center w-1/6">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3 text-center">{{ $application->id }}</td>
                <td class="px-6 py-3 text-center">{{ $application->applicant_first_name }} {{ $application->applicant_last_name }}</td>
                <td class="px-6 py-3 text-center">{{ $application->applicant_email }}</td>
                <td class="px-6 py-3 text-center">{{ $application->applicant_phone ?? '-' }}</td>
                <td class="px-6 py-3 text-center">{{ $application->career->career_name ?? '-' }}</td>
                <td class="px-6 py-3 text-center">
                    @if($application->file_path)
                    @php
                    $fileUrl = asset($application->file_path);
                    $extension = strtolower(pathinfo($fileUrl, PATHINFO_EXTENSION));
                    @endphp
                    <div class="flex flex-col items-center justify-center gap-1">
                        <button type="button"
                            class="view-resume-btn inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition"
                            data-url="{{ $fileUrl }}"
                            data-ext="{{ $extension }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            View Resume
                        </button>
                    </div>
                    @else
                    <span class="text-gray-400 italic">No Resume</span>
                    @endif
                </td>

                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center items-center gap-2">
                        <a href="{{ route('admin.career_applications.edit', $application->id) }}"
                            class="px-3 py-1 rounded text-white bg-blue-500 hover:bg-blue-600">Edit</a>
                        <form action="{{ route('admin.career_applications.destroy', $application->id) }}"
                            method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-btn px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>

<!-- Resume Viewer Modal -->
<div id="resumeModal"
    class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl w-full max-w-4xl h-[80vh] flex flex-col overflow-hidden">
        <div class="flex justify-between items-center bg-gray-100 px-4 py-2 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Resume Preview</h2>
            <button id="closeModal" class="text-gray-600 hover:text-red-600 text-xl">&times;</button>
        </div>
        <div id="resumeContent" class="flex-1 bg-gray-50 overflow-auto flex justify-center items-center">
            <p class="text-gray-400 italic">Loading preview...</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // DataTable
        $('#applications-table').DataTable({
            ordering: false
        });

        // SweetAlert Delete Confirmation
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: "Are you sure?",
                text: "This application will be permanently deleted.",
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

        // Resume Modal Logic
        const modal = $('#resumeModal');
        const content = $('#resumeContent');

        $(document).on('click', '.view-resume-btn', function() {
            const fileUrl = $(this).data('url');
            const ext = $(this).data('ext').toLowerCase();
            let viewer = '';

            if (['pdf'].includes(ext)) {
                viewer = `<iframe src="${fileUrl}" class="w-full h-full"></iframe>`;
            } else if (['doc', 'docx'].includes(ext)) {
                viewer = `<p class="text-gray-500 italic">
        Cannot preview Word files locally. 
        <a href="${fileUrl}" target="_blank" class="text-blue-600 underline">Download Resume</a>
    </p>`;
            } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
                viewer = `<img src="${fileUrl}" class="max-h-full object-contain mx-auto" />`;
            } else {
                viewer = `<p class="text-gray-500 italic">Preview not available for this file type.</p>`;
            }

            content.html(viewer);
            modal.removeClass('hidden');
        });

        $('#closeModal').on('click', function() {
            modal.addClass('hidden');
            content.html('<p class="text-gray-400 italic">Loading preview...</p>');
        });
    });
</script>

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