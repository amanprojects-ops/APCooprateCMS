@extends('admin.layouts.app')

@section('title', 'Tech Stacks')
@section('page-title', 'Tech Stacks')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Tech Stacks</span></div>
        <h1 class="content-title">Tech Stacks</h1>
        <p class="content-subtitle">{{ $stacks->total() }} technologies</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.tech-stacks.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.tech-stacks.create') }}" class="btn-admin btn-primary-admin" id="add-tech-stack-btn">
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
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stacks as $stack)
                <tr>
                    <td>
                        @if($stack->logo)
                            <img src="{{ Storage::url($stack->logo) }}" alt="{{ $stack->name }}" class="icon-thumb">
                        @else
                            <div class="icon-thumb d-flex align-items-center justify-content-center fw-700 text-muted-c" style="font-size:.75rem;background:#f1f5f9;">
                                {{ strtoupper(substr($stack->name,0,2)) }}
                            </div>
                        @endif
                    </td>
                    <td class="fw-600">{{ $stack->name }}</td>
                    <td>
                        @if($stack->category)
                            <span class="badge-admin badge-accent">{{ $stack->category }}</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($stack->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $stack->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.tech-stacks.edit', $stack) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-tech-{{ $stack->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.tech-stacks.destroy', $stack) }}', '{{ addslashes($stack->name) }}')"
                                    id="delete-tech-{{ $stack->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
                        <div class="empty-title">No tech stacks yet</div>
                        
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.tech-stacks.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.tech-stacks.create') }}" class="btn-admin btn-primary-admin" id="add-tech-stack-btn">
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
    @if($stacks->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $stacks->links() }}</div>
    @endif
</div>

@include('admin.partials.import-modal', ['title' => 'Tech Stacks', 'route' => route('admin.tech-stacks.import')])
@endsection
