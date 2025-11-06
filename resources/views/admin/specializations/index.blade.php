@extends('admin.layouts.adminapp')

@section('title', 'Specializations')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">Specializations</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <button type="button"
        onclick="openCreateModal()"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Create Specialization
    </button>
</div>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg p-4">
    <table id="specializations-table" class="min-w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 text-center w-1/4">ID</th>
                <th class="px-10 py-3 text-center w-1/2">Specialization Name</th>
                <th class="px-10 py-3 text-center w-[20%]">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($specializations as $specialization)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $specialization->id }}</td>
                <td class="px-10 py-3 text-center">{{ $specialization->specialization_name }}</td>
                <td class="px-6 py-3 text-center">
                    <form action="{{ route('admin.specialization.destroy', $specialization->id) }}" method="POST" class="inline-block delete-form">
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

<!-- Create Specialization Modal -->
<div id="create-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 w-[600px] max-w-full">
        <h2 class="text-lg font-semibold mb-6">CREATE SPECIALIZATION</h2>

        <form method="POST" action="{{ route('admin.specialization.store') }}">
            @csrf
            <div class="mb-4">
                <label for="specialization_name" class="block text-sm font-medium text-gray-700">Specialization Name</label>
                <input type="text" name="specialization_name" id="specialization_name"
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
<script>
    $(document).ready(function() {
        $('#specializations-table').DataTable({
            ordering: false
        });

        // SweetAlert delete confirmation
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "This specialization will be permanently deleted!",
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

        // Success message
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
        @endif
    });

    // Modal Functions
    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
        document.getElementById('specialization_name').value = '';
    }
</script>
@endpush