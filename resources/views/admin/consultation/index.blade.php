@extends('admin.layouts.adminapp')

@section('title', 'Contacts')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">CONTACTS</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-4">
    <a href="{{ route('admin.contacts.export') }}"
        class="ml-auto flex items-center gap-2 text-sm bg-green-700 hover:bg-green-800 transition px-6 py-3 rounded-lg shadow-md text-white">
        <!-- Excel Logo Icon -->
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
    <table class="table-fixed w-full border-collapse text-center"
        id="users-table">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 rounded-tl-lg text-center w-16">ID</th>
                <th class="px-10 py-3 text-center w-1/4">Name</th>
                <th class="px-10 py-3 text-center w-1/4">Email</th>
                <th class="px-10 py-3 text-center w-1/4">Phone Number</th>
                <th class="px-10 py-3 rounded-tr-lg text-center whitespace-nowrap w-40">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consultations as $consultation)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $consultation->id }}</td>
                <td class="px-10 py-3">{{ $consultation->name }}</td>
                <td class="px-10 py-3">{{ strip_tags($consultation->email) }}</td>
                <td class="px-10 py-3">{{ strip_tags($consultation->contact_num) }}</td>
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="flex justify-center items-center gap-2">
                        <button type="button"
                            onclick="confirmDelete({{ $consultation->id }})"
                            class="px-3 py-1 rounded text-white"
                            style="background-color:#EF4444;">
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
<script>
    function openDeleteModal(contactOd) {
        let form = document.getElementById('delete-form');
        form.action = "/admin/contacts/" + contactOd;
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
    // SweetAlert delete confirmation
    function confirmDelete(contactId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this contact? This action cannot be undone.",
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
                form.action = "/admin/consultations/" + contactId;

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
{{-- SweetAlert Success after CRUD --}}
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