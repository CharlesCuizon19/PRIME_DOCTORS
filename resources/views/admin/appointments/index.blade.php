@extends('admin.layouts.adminapp')

@section('title', 'Appointments')

@section('admin-content')
    <!-- Page Title -->
    <h1 class="text-2xl font-semibold mb-6">Appointments</h1>

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.appointment.export') }}"
            class="ml-auto flex items-center gap-2 text-lg bg-green-700 hover:bg-green-800 transition px-6 py-3 rounded-lg shadow-md text-white">
            <!-- Excel Icon -->
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
        <table class="table-fixed w-full border-collapse text-center" id="appointments-table">
            <thead>
                <tr class="bg-black text-white text-lg font-semibold">
                    <th class="px-10 py-3 rounded-tl-lg text-center w-16">ID</th>
                    <th class="px-10 py-3 text-center w-1/4">Doctor Name</th>
                    <!-- <th class="px-10 py-3 text-center w-1/4">Specialization</th> -->
                    <th class="px-10 py-3 text-center w-1/4">Patient Name</th>
                    <th class="px-10 py-3 text-center w-1/4">Phone Number</th>
                    <th class="px-10 py-3 text-center w-1/4">Appointment Date</th>
                    <th class="px-10 py-3 rounded-tr-lg text-center whitespace-nowrap w-40">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr id="row-{{ $appointment->id }}" class="border-t">
                        <td class="px-10 py-3">{{ $appointment->id }}</td>
                        <td class="px-10 py-3">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                        <!-- <td class="px-10 py-3">{{ $appointment->doctor->mainSpecialization->name ?? 'N/A' }}</td> -->
                        <td class="px-10 py-3">{{ $appointment->full_name }}</td>
                        <td class="px-10 py-3">{{ $appointment->phone_number }}</td>
                        <td class="px-10 py-3">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-3 whitespace-nowrap">
                            <div class="flex justify-center items-center gap-2">
                                <button type="button" onclick="deleteAppointment({{ $appointment->id }})"
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
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl shadow-lg p-8 w-[500px] max-w-full">
            <h2 class="text-lg font-semibold mb-4">CONFIRM DELETE</h2>
            <p class="text-gray-600 mb-6">Delete this appointment? This action cannot be undone.</p>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Cancel
                </button>

                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-white rounded bg-red-500 hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#appointments-table').DataTable({
                ordering: false
            });
        });

        function deleteAppointment(id) {
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
                        url: "/admin/appointments/" + id,
                        method: "POST",
                        data: {
                            _method: "DELETE",
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#appointments-table').DataTable().row($('#row-' + id)).remove().draw();

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The appointment has been deleted.',
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

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endpush
