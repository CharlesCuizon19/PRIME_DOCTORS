<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Prime Doctors - @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ✅ Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- ✅ DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- ✅ Swiper (optional for slides) -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- ✅ JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex bg-gray-50">
    <!-- ✅ Sidebar -->
    <div class="flex-shrink-0 w-64 bg-white border-r shadow-sm">
        @include('admin.navigation.sidebar')
    </div>

    <!-- ✅ Main Content -->
    <main class="flex-1 overflow-auto p-6">
        @yield('admin-content')
    </main>

    <!-- ✅ Script Stack -->
    @stack('scripts')
</body>

</html>

<!-- ✅ Styling -->
<style>
    * {
        font-family: "Roboto", sans-serif;
    }

    /* DataTable Header Styling */
    table.dataTable thead th {
        border-bottom: 1px solid #d1d5db;
        border-left: 1px solid #d1d5db;
        border-right: 1px solid #d1d5db;
        font-size: 12px;
        font-weight: bold;
        padding: 6px;
    }

    table.dataTable thead th.text-center {
        text-align: center !important;
    }

    table.dataTable thead th.text-left {
        text-align: left !important;
    }

    /* Body Cell Styling */
    table.dataTable td {
        border-bottom: 1px solid #d1d5db;
        border-left: 1px solid #d1d5db;
        border-right: 1px solid #d1d5db;
        font-size: 11px;
        font-weight: normal;
        padding: 6px;
        text-align: center;
        vertical-align: middle;
    }

    /* Footer Styling */
    table.dataTable tfoot th,
    table.dataTable tfoot td {
        border-top: 2px solid #d1d5db;
        border-left: 1px solid #d1d5db;
        border-right: 1px solid #d1d5db;
        font-size: 11px;
        font-weight: bold;
    }

    table.dataTable thead th:first-of-type,
    table.dataTable tfoot th:first-of-type {
        border-left: none;
    }

    /* Optional: SweetAlert animation */
    .swal2-popup {
        border-radius: 1rem !important;
    }
</style>