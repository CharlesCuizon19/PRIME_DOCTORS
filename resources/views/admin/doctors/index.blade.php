@extends('admin.layouts.adminapp')

@section('title', 'Doctors')

@section('admin-content')
<h1 class="text-2xl font-semibold mb-6">DOCTORS</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.doctors.create') }}"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <!-- Plus Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>

        Add a Doctor
    </a>
</div>

<!-- Doctors Table -->
<div class="overflow-x-auto bg-white border rounded-lg">
    <table id="doctors-table" class="table-fixed w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-4 py-3 text-center w-16">ID</th>
                <th class="px-4 py-3 text-center">Image</th>
                <th class="px-4 py-3 text-center">Name</th>
                <th class="px-4 py-3 text-center">Gender</th>
                <th class="px-4 py-3 text-center">Clinic Room</th>
                <th class="px-4 py-3 text-center">Clinic Hours</th>
                <th class="px-4 py-3 text-center">Specializations</th>
                <th class="px-4 py-3 text-center">Languages</th>
                <th class="px-4 py-3 text-center w-32">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($doctors as $doctor)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-3 text-center">{{ $doctor->id }}</td>
                <td class="px-6 py-3 text-center">
                    @if ($doctor->image && $doctor->image->file && $doctor->image->file->image_path)
                    <img src="{{ asset($doctor->image->file->image_path) }}" alt="{{ $doctor->image->alt_text ?? 'Banner' }}"
                        class="mx-auto w-24 h-12 object-cover rounded shadow">
                    @else
                    <span class="text-gray-400 italic">No Image</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-center">{{ $doctor->name }}</td>
                <td class="px-4 py-3 text-center">{{ ucfirst($doctor->gender) }}</td>
                <td class="px-4 py-3 text-center">{{ $doctor->clinic_room_number ?? '-' }}</td>
                <td class="px-4 py-3 text-center">{{ $doctor->clinic_hours ?? '-' }}</td>
                <td class="px-4 py-3 text-center">
                    @foreach($doctor->specializations as $spec)
                    <div>{{ $spec->specialization_name }}
                        <span class="text-gray-500 text-sm">
                            ({{ $spec->pivot->type ?? '—' }})
                        </span>
                    </div>
                    @endforeach

                </td>
                <td class="px-4 py-3 text-center">
                    @foreach($doctor->languages as $lang)
                    <span class="inline-block bg-green-100 text-green-800 px-2 py-1 text-sm rounded mr-1">
                        {{ $lang->language}}
                    </span>
                    @endforeach
                </td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Edit
                        </a>

                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this doctor?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>
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
<!-- ✅ Include DataTables -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.tailwindcss.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#doctors-table').DataTable({
            ordering: false,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search doctors..."
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    @endif
</script>
@endpush