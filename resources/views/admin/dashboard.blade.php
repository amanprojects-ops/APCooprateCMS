@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . auth()->user()->name)

@section('content')

{{-- Stat Cards Row --}}
<div class="row g-3 mb-4">

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#0ea5e9;--stat-icon-bg:rgba(14,165,233,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['services'] }}</div>
                <div class="stat-label">Services</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#7c3aed;--stat-icon-bg:rgba(124,58,237,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                    <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['products'] }}</div>
                <div class="stat-label">Products</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#f59e0b;--stat-icon-bg:rgba(245,158,11,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                    <polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['projects'] }}</div>
                <div class="stat-label">Projects</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#22c55e;--stat-icon-bg:rgba(34,197,94,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['published_posts'] }}</div>
                <div class="stat-label">Blog Posts</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#ef4444;--stat-icon-bg:rgba(239,68,68,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['new_inquiries'] }}</div>
                <div class="stat-label">New Inquiries</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#f97316;--stat-icon-bg:rgba(249,115,22,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ $stats['testimonials'] }}</div>
                <div class="stat-label">Testimonials</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#06b6d4;--stat-icon-bg:rgba(6,182,212,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ \App\Models\TechStack::count() }}</div>
                <div class="stat-label">Tech Stacks</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="stat-card" style="--stat-color:#8b5cf6;--stat-icon-bg:rgba(139,92,246,.1);">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>
                </svg>
            </div>
            <div class="stat-body">
                <div class="stat-value">{{ \App\Models\PricingPlan::count() }}</div>
                <div class="stat-label">Pricing Plans</div>
            </div>
        </div>
    </div>

</div>

{{-- Bottom two columns --}}
<div class="row g-3">

    {{-- Recent Inquiries --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="card-header-admin">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" width="16" height="16" style="margin-right:6px;">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Recent Inquiries
                </h3>
                <a href="{{ route('admin.contact-inquiries.index') }}" class="btn-admin btn-secondary-admin btn-sm-admin">View All</a>
            </div>
            <div class="table-responsive-admin">
                <table class="table-admin">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_inquiries as $inq)
                            <tr>
                                <td>
                                    <div class="fw-600" style="font-size:.83rem;">{{ $inq->name }}</div>
                                    <div style="font-size:.73rem;color:#64748b;">{{ $inq->email }}</div>
                                </td>
                                <td class="truncate" style="max-width:160px;">{{ $inq->subject ?? 'No Subject' }}</td>
                                <td>
                                    @php
                                        $badge = match($inq->status) {
                                            'new'     => 'badge-accent',
                                            'read'    => 'badge-info',
                                            'replied' => 'badge-success',
                                            'closed'  => 'badge-muted',
                                            default   => 'badge-muted',
                                        };
                                    @endphp
                                    <span class="badge-admin {{ $badge }}">{{ ucfirst($inq->status) }}</span>
                                </td>
                                <td style="font-size:.78rem;color:#64748b;">{{ $inq->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg></div>
                                    <div class="empty-title">No inquiries yet</div>
                                </div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Blog Posts --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="card-header-admin">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" width="16" height="16" style="margin-right:6px;">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                    Recent Posts
                </h3>
                <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-primary-admin btn-sm-admin">
                    + New Post
                </a>
            </div>
            <div class="card-body-admin" style="padding:0;">
                @forelse($recent_posts as $post)
                    <div style="padding:12px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:12px;">
                        @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="img-thumb" style="width:46px;height:34px;">
                        @else
                            <div style="width:46px;height:34px;background:#f1f5f9;border-radius:6px;flex-shrink:0;"></div>
                        @endif
                        <div style="flex:1;min-width:0;">
                            <div class="truncate fw-600" style="font-size:.83rem;">{{ $post->title }}</div>
                            <div style="font-size:.72rem;color:#64748b;margin-top:2px;">
                                @if($post->is_published)
                                    <span class="badge-admin badge-success" style="font-size:.65rem;">Published</span>
                                @else
                                    <span class="badge-admin badge-muted" style="font-size:.65rem;">Draft</span>
                                @endif
                                &nbsp;{{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        <a href="{{ route('admin.blog-posts.edit', $post) }}"
                           style="color:#0ea5e9;font-size:.78rem;text-decoration:none;font-weight:600;white-space:nowrap;">
                            Edit
                        </a>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg></div>
                        <div class="empty-title">No posts yet</div>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="admin-card mt-3">
            <div class="card-header-admin">
                <h3>Quick Actions</h3>
            </div>
            <div class="card-body-admin">
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.services.create') }}" class="btn-admin btn-secondary-admin btn-sm-admin w-100 justify-content-start">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        New Service
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-secondary-admin btn-sm-admin w-100 justify-content-start">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        New Project
                    </a>
                    <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-secondary-admin btn-sm-admin w-100 justify-content-start">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        New Blog Post
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="btn-admin btn-secondary-admin btn-sm-admin w-100 justify-content-start">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41"/></svg>
                        Site Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
