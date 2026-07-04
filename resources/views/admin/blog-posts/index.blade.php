@extends('admin.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Blog Posts</span></div>
        <h1 class="content-title">Blog Posts</h1>
        <p class="content-subtitle">{{ $posts->total() }} total</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.blog-posts.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-primary-admin" id="add-blog-post-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add
        </a>
    </div>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-toolbar">
        <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" placeholder="Search posts...">
        </div>
    </div>
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr class="{{ $post->trashed() ? 'opacity-50' : '' }}">
                    <td>
                        @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="img-thumb">
                        @else
                            <div class="img-thumb d-flex align-items-center justify-content-center bg-light">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" width="16" height="16"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-600 truncate" style="max-width:220px;">{{ $post->title }}</div>
                        @if($post->is_featured)
                            <span class="badge-admin badge-warning" style="font-size:.62rem;">⭐ Featured</span>
                        @endif
                    </td>
                    <td>
                        @if($post->category)
                            <span class="badge-admin badge-accent">{{ $post->category }}</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($post->trashed())
                            <span class="badge-admin badge-danger">Deleted</span>
                        @elseif($post->is_published)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Published</span>
                        @else
                            <span class="badge-admin badge-warning">Draft</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ number_format($post->views) }}</td>
                    <td style="font-size:.78rem;color:#64748b;">
                        {{ $post->published_at?->format('M d, Y') ?? '—' }}
                    </td>
                    <td>
                        <div class="table-actions">
                            @if(!$post->trashed())
                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-post-{{ $post->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.blog-posts.destroy', $post) }}', '{{ addslashes($post->title) }}')"
                                    id="delete-post-{{ $post->id }}">Del</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg></div>
                        <div class="empty-title">No blog posts yet</div>
                        
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.blog-posts.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn-admin btn-primary-admin" id="add-blog-post-btn">
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
    @if($posts->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $posts->links() }}</div>
    @endif
</div>

@include('admin.partials.import-modal', ['title' => 'Blog Posts', 'route' => route('admin.blog-posts.import')])
@endsection
