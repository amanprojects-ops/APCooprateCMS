@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')
@section('page-subtitle', 'Manage portfolio projects')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Projects</span>
        </div>
        <h1 class="content-title">Projects</h1>
        <p class="content-subtitle">{{ $projects->total() }} total</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.projects.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-primary-admin" id="add-project-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-toolbar">
        <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Search projects...">
        </div>
    </div>
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Client</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr class="{{ $project->trashed() ? 'opacity-50' : '' }}">
                    <td>
                        @if($project->thumbnail)
                            <img src="{{ Storage::url($project->thumbnail) }}" alt="" class="img-thumb">
                        @else
                            <div class="img-thumb d-flex align-items-center justify-content-center bg-light">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" width="18" height="18"><polygon points="12 2 2 7 12 12 22 7 12 2"/></svg>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-600">{{ $project->title }}</div>
                        <div class="text-muted-c" style="font-size:.73rem;">
                            {{ $project->completed_at?->format('M Y') ?? 'Ongoing' }}
                        </div>
                    </td>
                    <td class="text-muted-c" style="font-size:.83rem;">{{ $project->client_name ?? '—' }}</td>
                    <td>
                        @if($project->category)
                            <span class="badge-admin badge-accent">{{ $project->category }}</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($project->is_featured)
                            <span class="badge-admin badge-warning">⭐ Featured</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($project->trashed())
                            <span class="badge-admin badge-danger">Deleted</span>
                        @elseif($project->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $project->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            @if(!$project->trashed())
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-project-{{ $project->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.projects.destroy', $project) }}', '{{ addslashes($project->title) }}')"
                                    id="delete-project-{{ $project->id }}">Del</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/></svg></div>
                        <div class="empty-title">No projects yet</div>
                        
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.projects.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.projects.create') }}" class="btn-admin btn-primary-admin" id="add-project-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projects->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $projects->links() }}</div>
    @endif
</div>

@include('admin.partials.import-modal', ['title' => 'Projects', 'route' => route('admin.projects.import')])
@endsection
