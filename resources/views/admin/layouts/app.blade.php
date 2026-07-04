<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — AmanProjects Admin</title>
    <meta name="description" content="AmanProjects CMS Admin Panel">

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Admin Design System --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

{{-- Alpine root with sidebar state --}}
<div class="admin-wrapper" x-data="{ sidebarOpen: false }">

    {{-- Mobile Overlay --}}
    <div class="sidebar-overlay" :class="{ 'active': sidebarOpen }" @click="sidebarOpen = false"></div>

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Area --}}
    <div class="admin-main">

        {{-- Top Navigation --}}
        @include('admin.partials.topnav')

        {{-- Page Content --}}
        <main class="admin-content" id="main-content">
            {{-- Flash Alerts --}}
            @include('admin.partials.alerts')

            {{-- Page content injected here --}}
            @yield('content')
        </main>

    </div>{{-- /.admin-main --}}

</div>{{-- /.admin-wrapper --}}

{{-- Delete Confirmation Modal (global, triggered by any delete button) --}}
@include('admin.partials.delete-modal')

{{-- Alpine.js --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.alert-admin[data-auto-dismiss]').forEach(function(el) {
            setTimeout(function() {
                el.style.transition = 'opacity 0.4s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 5000);
        });
    });
</script>

@stack('scripts')
</body>
</html>
