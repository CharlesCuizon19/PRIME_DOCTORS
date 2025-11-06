@extends('admin.layouts.adminapp')

@section('title', 'Inclusions')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">Inclusions</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <button type="button"
        onclick="openCreateModal()"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Create Inclusions
    </button>
</div>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg p-4">
    <table id="inclusions-table" class="min-w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 text-center w-1/4">ID</th>
                <th class="px-10 py-3 text-center w-1/2">Inclusion Name</th>
                <th class="px-10 py-3 text-center w-[20%]">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inclusions as $inclusion)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $inclusion->id }}</td>
                <td class="px-10 py-3 text-center">{{ $inclusion->inclusion_name }}</td>
                <td class="px-6 py-3 text-center">
                    <form action="{{ route('admin.inclusions.destroy', $inclusion->id) }}" method="POST" class="inline-block delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 rounded text-white bg-red-500 hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Inclusion Modal -->
<div id="create-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 w-[600px] max-w-full">
        <h2 class="text-lg font-semibold mb-6">CREATE INCLUSION</h2>

        <form method="POST" action="{{ route('admin.inclusions.store') }}">
            @csrf
            <div class="mb-4">
                <label for="inclusion_name" class="block text-sm font-medium text-gray-700">Inclusion Name</label>
                <input type="text" name="inclusion_name" id="inclusion_name"
                    class="mt-1 block w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeCreateModal()"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-black text-white rounded hover:bg-gray-800">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- ✅ Include DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script>
    $(document).ready(function() {
        // ✅ Initialize DataTables
        $('#inclusions-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                zeroRecords: "No matching inclusions found",
                info: "Showing _START_ to _END_ of _TOTAL_ inclusions",
                infoEmpty: "No inclusions available",
                infoFiltered: "(filtered from _MAX_ total records)"
            }
        });

        // ✅ SweetAlert delete confirmation
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "This inclusion will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });

        // ✅ SweetAlert for flash messages
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}", // ✅ Fixed quote issue
            showConfirmButton: false,
            timer: 2000
        });
        @endif
    });

    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
        document.getElementById('inclusion_name').value = '';
    }
</script>
@endpush