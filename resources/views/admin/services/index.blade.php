@extends('admin.layouts.adminapp')

@section('title', 'Services')

@section('admin-content')
<!-- Page Title -->
<h1 class="text-2xl font-semibold mb-6">SERVICES</h1>

<!-- Top Bar -->
<div class="flex justify-between items-center mb-6">
    <!-- Create Button -->
    <a href="{{ route('admin.services.create') }}"
        class="ml-auto inline-flex items-center gap-2 text-sm bg-gradient-to-r from-green-600 to-emerald-500 text-white px-6 py-3 rounded-xl shadow-md hover:shadow-lg hover:scale-105 transition-transform duration-200">

        <!-- Plus Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>

        Create Service
    </a>
</div>

<!-- Table -->
<div class="overflow-x-auto bg-white border rounded-lg">
    <table id="services-table" class="table-fixed w-full border-collapse">
        <thead>
            <tr class="bg-black text-white text-sm font-semibold">
                <th class="px-10 py-3 rounded-tl-lg text-center w-16">ID</th>
                <th class="px-10 py-3 w-1/4 text-center">Title</th>
                <th class="px-10 py-3 w-1/4 text-center">Description</th>
                <th class="px-10 py-3 w-1/4 text-center">Why It Matters</th>
                <th class="px-10 py-3 text-center w-1/4">Benefits</th>
                <th class="px-10 py-3 text-center w-1/4">Inclusions</th>
                <th class="px-10 py-3 text-center w-1/4">Icon</th>
                <th class="px-10 py-3 text-center w-1/4">Image</th>
                <th class="px-10 py-3 rounded-tr-lg text-center whitespace-nowrap w-40">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($services as $service)
            <tr class="border-t">
                <td class="px-10 py-3 text-center">{{ $service->id }}</td>
                <td class="px-10 py-3 text-center">{{ $service->title }}</td>
                <td class="px-10 py-3 text-center">{!! Str::limit(strip_tags($service->description), 80) !!}</td>
                <td class="px-10 py-3 text-center">{!! Str::limit(strip_tags($service->why_it_matters), 80) !!}</td>

                <td class="px-10 py-3 text-center">
                    @if($service->benefits->isNotEmpty())
                    <ul class="list-disc list-inside">
                        @foreach($service->benefits as $benefit)
                        <li>{{ $benefit->benefit_name }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span class="text-gray-400 italic">None</span>
                    @endif
                </td>

                <td class="px-10 py-3 text-center">
                    @if($service->inclusions->isNotEmpty())
                    <ul class="list-disc list-inside">
                        @foreach($service->inclusions as $inclusion)
                        <li>{{ $inclusion->inclusion_name }}</li>
                        @endforeach
                    </ul>
                    @else
                    <span class="text-gray-400 italic">None</span>
                    @endif
                </td>


                {{-- 🧩 Icon Image --}}
                <td class="px-10 py-3 text-center">
                    @if($service->icon_image_id && $service->icon && $service->icon->file)
                    <img src="{{ asset('storage/' . $service->icon->file->image_path) }}"
                        alt="{{ $service->title }} Icon"
                        class="h-12 w-12 object-contain rounded shadow mx-auto">
                    @elseif(isset($service->icon_image_id))
                    {{-- Fallback path if icon relation is missing --}}
                    <img src="{{ asset('storage/services/icons/' . basename(optional($service->icon)?->file?->image_path ?? '')) }}"
                        alt="{{ $service->title }} Icon"
                        class="h-12 w-12 object-contain rounded shadow mx-auto">
                    @else
                    <span class="text-gray-400 italic">No Icon</span>
                    @endif
                </td>

                {{-- 🖼 Service Image --}}
                <td class="px-10 py-3 text-center">
                    @if($service->service_image_id && $service->image && $service->image->file)
                    <img src="{{ asset('storage/' . $service->image->file->image_path) }}"
                        alt="{{ $service->title }} Image"
                        class="h-12 w-20 object-cover rounded shadow mx-auto">
                    @elseif(isset($service->service_image_id))
                    {{-- Fallback path if relationship missing --}}
                    <img src="{{ asset('storage/services/' . basename(optional($service->image)?->file?->image_path ?? '')) }}"
                        alt="{{ $service->title }} Image"
                        class="h-12 w-20 object-cover rounded shadow mx-auto">
                    @else
                    <span class="text-gray-400 italic">No Image</span>
                    @endif
                </td>

                {{-- ⚙️ Actions --}}
                <td class="px-6 py-3 whitespace-nowrap">
                    <div class="flex justify-center items-center gap-2">
                        <a href="{{ route('admin.services.edit', $service->id) }}"
                            class="px-3 py-1 rounded text-white bg-blue-500 hover:bg-blue-600">
                            Edit
                        </a>

                        <button type="button"
                            onclick="confirmDelete({{ $service->id }})"
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
        $('#services-table').DataTable({
            ordering: false,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search services..."
            }
        });
    });

    // ✅ SweetAlert Delete Confirmation
    function confirmDelete(serviceId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Delete this service? This action cannot be undone.",
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
                form.action = "/admin/services/" + serviceId;

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