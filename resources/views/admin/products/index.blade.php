@extends('admin.layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage SaaS products')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Products</span></div>
        <h1 class="content-title">Products</h1>
        <p class="content-subtitle">{{ $products->total() }} total</p>
    </div>
    
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.products.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.products.create') }}" class="btn-admin btn-primary-admin" id="add-product-btn">
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
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Links</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="{{ $product->trashed() ? 'opacity-50' : '' }}">
                    <td>
                        @if($product->thumbnail)
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="" class="img-thumb">
                        @else
                            <div class="img-thumb d-flex align-items-center justify-content-center bg-light">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" width="16" height="16"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-600">{{ $product->name }}</div>
                        @if($product->tagline)
                            <div style="font-size:.73rem;color:#64748b;">{{ $product->tagline }}</div>
                        @endif
                    </td>
                    <td>
                        @if($product->category)
                            <span class="badge-admin badge-accent">{{ $product->category }}</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;flex-direction:column;gap:3px;">
                            @if($product->demo_url)
                                <a href="{{ $product->demo_url }}" target="_blank" style="font-size:.72rem;color:#0ea5e9;text-decoration:none;">🔗 Demo</a>
                            @endif
                            @if($product->github_url)
                                <a href="{{ $product->github_url }}" target="_blank" style="font-size:.72rem;color:#64748b;text-decoration:none;">⚙ GitHub</a>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($product->is_featured)
                            <span class="badge-admin badge-warning">⭐ Yes</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($product->trashed())
                            <span class="badge-admin badge-danger">Deleted</span>
                        @elseif($product->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $product->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            @if(!$product->trashed())
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-product-{{ $product->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.products.destroy', $product) }}', '{{ addslashes($product->name) }}')"
                                    id="delete-product-{{ $product->id }}">Del</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg></div>
                        <div class="empty-title">No products yet</div>
                        
    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.products.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
        <a href="{{ route('admin.products.create') }}" class="btn-admin btn-primary-admin" id="add-product-btn">
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
    @if($products->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $products->links() }}</div>
    @endif
</div>

@include('admin.partials.import-modal', ['title' => 'Products', 'route' => route('admin.products.import')])
@endsection
