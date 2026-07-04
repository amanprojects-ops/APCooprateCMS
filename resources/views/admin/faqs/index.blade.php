@extends('admin.layouts.app')

@section('title', 'FAQs')
@section('page-title', 'FAQs')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>FAQs</span></div>
        <h1 class="content-title">Frequently Asked Questions</h1>
        <p class="content-subtitle">{{ $faqs->total() }} questions</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="btn-admin btn-primary-admin" id="add-faq-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add FAQ
    </a>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr>
                    <td>
                        <div class="fw-600" style="max-width:360px;">{{ Str::limit($faq->question, 80) }}</div>
                        <div class="truncate text-muted-c" style="font-size:.73rem;max-width:360px;">{{ Str::limit($faq->answer, 80) }}</div>
                    </td>
                    <td>
                        @if($faq->category)
                            <span class="badge-admin badge-accent">{{ $faq->category }}</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($faq->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $faq->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-faq-{{ $faq->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.faqs.destroy', $faq) }}', 'FAQ #{{ $faq->id }}')"
                                    id="delete-faq-{{ $faq->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
                        <div class="empty-title">No FAQs yet</div>
                        <a href="{{ route('admin.faqs.create') }}" class="btn-admin btn-primary-admin btn-sm-admin mt-2">Add FAQ</a>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($faqs->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $faqs->links() }}</div>
    @endif
</div>
@endsection
