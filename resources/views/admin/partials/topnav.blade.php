{{-- ===================================================
     TOPNAV PARTIAL
     =================================================== --}}
<header class="admin-topnav" role="banner">

    {{-- Mobile Hamburger --}}
    <button class="topnav-toggle"
            @click="sidebarOpen = !sidebarOpen"
            aria-label="Toggle sidebar"
            id="sidebar-toggle-btn"
            type="button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    {{-- Page Title / Breadcrumb --}}
    <div class="topnav-breadcrumb">
        <div class="topnav-title">@yield('page-title', 'Dashboard')</div>
        @hasSection('page-subtitle')
            <div class="topnav-sub">@yield('page-subtitle')</div>
        @endif
    </div>

    {{-- Right Actions --}}
    <div class="topnav-actions">

        {{-- Home Link --}}
        <a href="{{ url('/') }}" class="topnav-icon-btn" target="_blank" title="View website" id="topnav-website-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="2" y1="12" x2="22" y2="12"/>
                <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
            </svg>
        </a>

        {{-- Admin Dropdown --}}
        <div class="topnav-admin-wrapper" x-data="{ open: false }">
            <button class="topnav-admin-btn"
                    @click="open = !open"
                    @click.away="open = false"
                    id="topnav-user-menu"
                    aria-expanded="false"
                    type="button">
                <div class="topnav-admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="topnav-admin-name">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="topnav-admin-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </span>
            </button>

            {{-- Dropdown Menu --}}
            <div class="topnav-dropdown" x-show="open" x-transition x-cloak>
                <div class="px-3 py-2" style="border-bottom:1px solid #f1f5f9;margin-bottom:4px;">
                    <div style="font-size:.78rem;font-weight:700;color:#0f172a;">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div style="font-size:.72rem;color:#64748b;">{{ auth()->user()->email ?? '' }}</div>
                </div>

                <a href="{{ route('admin.settings.index') }}" class="topnav-dd-item" id="dd-settings">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M20 12h2M2 12h2M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41M12 20v2M12 2v2"/>
                    </svg>
                    Settings
                </a>

                <hr class="topnav-dd-divider">

                <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="topnav-dd-item danger" id="dd-logout">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

</header>
