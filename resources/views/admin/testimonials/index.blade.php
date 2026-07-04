@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Testimonials</span></div>
        <h1 class="content-title">Testimonials</h1>
        <p class="content-subtitle">{{ $testimonials->total() }} total</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.testimonials.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-admin btn-primary-admin" id="add-testimonial-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            @if($t->client_avatar)
                                <img src="{{ Storage::url($t->client_avatar) }}" alt="" class="avatar-thumb">
                            @else
                                <div class="avatar-thumb d-flex align-items-center justify-content-center bg-light fw-700 text-muted-c" style="font-size:.75rem;">
                                    {{ strtoupper(substr($t->client_name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="fw-600" style="font-size:.83rem;">{{ $t->client_name }}</div>
                                <div style="font-size:.72rem;color:#64748b;">{{ $t->client_designation }}{{ $t->client_company ? ', '.$t->client_company : '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="truncate" style="max-width:220px;font-size:.83rem;">{{ Str::limit($t->review, 70) }}</td>
                    <td>
                        <div class="star-display">
                            @for($i=1;$i<=5;$i++)
                                <span class="star {{ $i <= $t->rating ? 'on' : '' }}">★</span>
                            @endfor
                        </div>
                    </td>
                    <td>
                        @if($t->is_featured)
                            <span class="badge-admin badge-warning">⭐ Yes</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($t->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $t->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-testimonial-{{ $t->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.testimonials.destroy', $t) }}', '{{ addslashes($t->client_name) }}')"
                                    id="delete-testimonial-{{ $t->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>
                        <div class="empty-title">No testimonials yet</div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($testimonials->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $testimonials->links() }}</div>
    @endif
</div>

@include('admin.partials.import-modal', ['title' => 'Testimonials', 'route' => route('admin.testimonials.import')])
@endsection
