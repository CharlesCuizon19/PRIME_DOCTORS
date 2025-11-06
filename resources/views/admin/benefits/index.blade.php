@extends('admin.layouts.adminapp')

@section('title', 'Benefits')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">Benefits</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <button type="button"
        onclick="openCreateModal()"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Create Benefit
    </button>
</div>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg p-4">
    <table id="benefits-table" class="min-w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 text-center w-1/4">ID</th>
                <th class="px-10 py-3 text-center w-1/2">Benefit Name</th>
                <th class="px-10 py-3 text-center w-[20%]">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($benefits as $benefit)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $benefit->id }}</td>
                <td class="px-10 py-3 text-center">{{ $benefit->benefit_name }}</td>
                <td class="px-6 py-3 text-center">
                    <form action="{{ route('admin.benefits.destroy', $benefit->id) }}" method="POST" class="inline-block delete-form">
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

<!-- Create Benefit Modal -->
<div id="create-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 w-[600px] max-w-full">
        <h2 class="text-lg font-semibold mb-6">CREATE BENEFIT</h2>

        <form method="POST" action="{{ route('admin.benefits.store') }}">
            @csrf
            <div class="mb-4">
                <label for="benefit_name" class="block text-sm font-medium text-gray-700">Benefit Name</label>
                <input type="text" name="benefit_name" id="benefit_name"
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
        $('#benefits-table').DataTable({
            ordering: false
        });

        // ✅ SweetAlert delete confirmation
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "This benefit will be permanently deleted!",
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

        // ✅ SweetAlert for success messages (after create/delete)
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

    // ✅ Modal Functions
    function openCreateModal() {
        document.getElementById('create-modal').classList.remove('hidden');
    }

    function closeCreateModal() {
        document.getElementById('create-modal').classList.add('hidden');
        document.getElementById('benefit_name').value = '';
    }
</script>
@endpush