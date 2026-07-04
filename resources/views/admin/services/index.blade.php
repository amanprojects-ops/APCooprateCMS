@extends('admin.layouts.app')

@section('title', 'Services')
@section('page-title', 'Services')
@section('page-subtitle', 'Manage company services')

@section('content')

{{-- Header --}}
<div class="content-header">
    <div class="content-header-left">
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <span class="breadcrumb-sep">/</span>
            <span>Services</span>
        </div>
        <h1 class="content-title">Services</h1>
        <p class="content-subtitle">{{ $services->total() }} total service(s)</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.services.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.services.create') }}" class="btn-admin btn-primary-admin" id="add-service-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
</div>

{{-- Table Card --}}
<div class="admin-card" x-data="deleteModal()">
    <div class="table-toolbar">
        <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Search services..." id="service-search">
        </div>
        <span class="badge-admin badge-info ms-auto">{{ $services->count() }} shown</span>
    </div>

    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th width="60">Sort</th>
                    <th width="130">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr class="{{ $service->trashed() ? 'opacity-50' : '' }}">
                    <td class="text-muted-c" style="font-size:.78rem;">{{ $service->id }}</td>
                    <td>
                        <div class="fw-600">{{ $service->title }}</div>
                        <div class="truncate text-muted-c" style="font-size:.73rem;max-width:200px;">
                            {{ Str::limit($service->short_description, 60) }}
                        </div>
                    </td>
                    <td><code style="font-size:.75rem;background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ $service->slug }}</code></td>
                    <td>
                        @if($service->icon)
                            <code style="font-size:.78rem;color:#0ea5e9;">{{ $service->icon }}</code>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($service->trashed())
                            <span class="badge-admin badge-danger">Deleted</span>
                        @elseif($service->is_active)
                            <span class="badge-admin badge-success">
                                <span class="status-dot active"></span> Active
                            </span>
                        @else
                            <span class="badge-admin badge-muted">
                                <span class="status-dot inactive"></span> Inactive
                            </span>
                        @endif
                    </td>
                    <td class="text-muted-c" style="font-size:.83rem;">{{ $service->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            @if($service->trashed())
                                <form action="{{ route('admin.services.restore', $service->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-admin btn-success-admin btn-xs-admin">Restore</button>
                                </form>
                            @else
                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="btn-admin btn-secondary-admin btn-xs-admin"
                                   id="edit-service-{{ $service->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <button type="button"
                                        class="btn-admin btn-danger-admin btn-xs-admin"
                                        @click="confirm('{{ route('admin.services.destroy', $service) }}', '{{ addslashes($service->title) }}')"
                                        id="delete-service-{{ $service->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13">
                                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                                    </svg>
                                    Delete
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <div class="empty-title">No services found</div>
                            <div class="empty-text">Add your first service to showcase what you offer.</div>
                            
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.services.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.services.create') }}" class="btn-admin btn-primary-admin" id="add-service-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($services->hasPages())
    <div style="padding:14px 20px;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;">
        <span style="font-size:.78rem;color:#64748b;">
            Showing {{ $services->firstItem() }}–{{ $services->lastItem() }} of {{ $services->total() }}
        </span>
        <div class="pagination-admin">
            {{ $services->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
    @endif

</div>

@include('admin.partials.import-modal', ['title' => 'Services', 'route' => route('admin.services.import')])
@endsection
