{{-- ===================================================
     SIDEBAR PARTIAL
     Requires Alpine.js x-data="{ sidebarOpen }" on parent
     =================================================== --}}
<aside class="admin-sidebar" :class="{ 'sidebar-open': sidebarOpen }">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <div>
            <div class="sidebar-brand-name">AmanProjects</div>
            <div class="sidebar-brand-sub">Admin Panel</div>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav" role="navigation" aria-label="Admin navigation">

        {{-- Overview --}}
        <p class="sidebar-section-label">Overview</p>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}"
           id="nav-dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Dashboard
            @php $newInquiries = \App\Models\ContactInquiry::where('status','new')->count(); @endphp
            @if($newInquiries > 0)
                <span class="nav-badge">{{ $newInquiries }}</span>
            @endif
        </a>

        {{-- Content --}}
        <p class="sidebar-section-label">Content</p>

        <a href="{{ route('admin.services.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.services*') ? 'active' : '' }}"
           id="nav-services">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
            </svg>
            Services
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}"
           id="nav-products">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
            </svg>
            Products
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}"
           id="nav-projects">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
            </svg>
            Projects
        </a>

        <a href="{{ route('admin.screenshots.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.screenshots*') ? 'active' : '' }}"
           id="nav-screenshots">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
            </svg>
            Screenshots
        </a>

        <a href="{{ route('admin.blog-posts.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.blog-posts*') ? 'active' : '' }}"
           id="nav-blog">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
            </svg>
            Blog Posts
        </a>

        {{-- Catalog --}}
        <p class="sidebar-section-label">Catalog</p>

        <a href="{{ route('admin.tech-stacks.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.tech-stacks*') ? 'active' : '' }}"
           id="nav-techstacks">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
            </svg>
            Tech Stacks
        </a>

        <a href="{{ route('admin.pricing-plans.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.pricing-plans*') ? 'active' : '' }}"
           id="nav-pricing">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
            </svg>
            Pricing Plans
        </a>

        <a href="{{ route('admin.faqs.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}"
           id="nav-faqs">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            FAQs
        </a>

        <a href="{{ route('admin.stats.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.stats*') ? 'active' : '' }}"
           id="nav-stats">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
            Stats
        </a>

        {{-- People --}}
        <p class="sidebar-section-label">People</p>

        <a href="{{ route('admin.testimonials.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}"
           id="nav-testimonials">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
            </svg>
            Testimonials
        </a>

        <a href="{{ route('admin.contact-inquiries.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.contact-inquiries*') ? 'active' : '' }}"
           id="nav-inquiries">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            Inquiries
            @if(isset($newInquiries) && $newInquiries > 0)
                <span class="nav-badge">{{ $newInquiries }}</span>
            @endif
        </a>

        {{-- System --}}
        <p class="sidebar-section-label">System</p>

        <a href="{{ route('admin.settings.index') }}"
           class="sidebar-nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
           id="nav-settings">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M20 12h2M2 12h2M19.07 19.07l-1.41-1.41M4.93 19.07l1.41-1.41M12 20v2M12 2v2"/>
            </svg>
            Settings
        </a>

    </nav>

    {{-- User Footer --}}
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
                <div class="sidebar-user-role">Super Admin</div>
            </div>
        </div>
    </div>

</aside>
