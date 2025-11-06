@extends('admin.layouts.adminapp')

@section('title', 'Newsletter')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">Newsletter</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-4">
    <a href="{{ route('admin.newsletter.export') }}"
        class="ml-auto flex items-center gap-2 text-sm bg-green-700 hover:bg-green-800 transition px-6 py-3 rounded-lg shadow-md text-white">
        <!-- Excel Logo -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
            <path fill="#185C37" d="M22.5 6h19v36h-19z" />
            <path fill="#21A366" d="M9.5 6h13v36h-13z" />
            <path fill="#107C41" d="M22.5 6h6.5v36h-6.5z" />
            <path fill="#fff" d="M16 17h2.5l3 5.5 3-5.5H27l-4.25 7 4.25 7h-2.5l-3-5.5-3 5.5H16l4.25-7-4.25-7z" />
        </svg>
        <span class="font-medium">Export to Excel</span>
    </a>
</div>


<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg">
    <table class="table-fixed w-full border-collapse text-center" id="users-table">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 rounded-tl-lg text-center w-16">ID</th>
                <th class="px-10 py-3 w-1/4">Email</th>
                <th class="px-10 py-3 rounded-tr-lg text-center whitespace-nowrap w-40">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($newsletters as $newsletter)
            <tr id="row-{{ $newsletter->id }}" class="border-t">
                <td class="px-10 py-3">{{ $newsletter->id }}</td>
                <td class="px-10 py-3">{{ strip_tags($newsletter->email) }}</td>
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="flex justify-center items-center gap-2">
                        <button type="button"
                            onclick="deleteNewsletter({{ $newsletter->id }})"
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


<!-- Delete Confirmation Modal -->
<div id="delete-modal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 w-[500px] max-w-full">
        <h2 class="text-lg font-semibold mb-4">CONFIRM DELETE</h2>
        <p class="text-gray-600 mb-6">Delete this newsletter? This action cannot be undone</p>

        <div class="flex justify-end space-x-3">
            <button type="button"
                onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Cancel
            </button>

            <form id="delete-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 text-white rounded"
                    style="background-color:#EF4444;">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    function openDeleteModal(newsletterId) {
        let form = document.getElementById('delete-form');
        form.action = "/admin/newsletters/" + newsletterId;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    $(document).ready(function() {
        $('#users-table').DataTable({
            ordering: false
        });
    });

    function deleteNewsletter(inquireId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/newsletters/" + inquireId, // ✅ singular
                    method: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#users-table').DataTable().row($('#row-' + inquireId)).remove().draw();

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The newsletter has been deleted.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Something went wrong.',
                            confirmButtonColor: '#EF4444'
                        });
                    }
                });
            }
        });
    }
</script>
@endpush