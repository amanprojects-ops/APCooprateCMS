@extends('admin.layouts.app')

@section('title', 'Homepage Stats')
@section('page-title', 'Homepage Stats')
@section('page-subtitle', 'Counter numbers shown on homepage')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Stats</span></div>
        <h1 class="content-title">Homepage Stats</h1>
    </div>
    <a href="{{ route('admin.stats.create') }}" class="btn-admin btn-primary-admin" id="add-stat-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Stat
    </a>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Suffix</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $stat)
                <tr>
                    <td class="fw-600">{{ $stat->label }}</td>
                    <td>
                        <span style="font-size:1.1rem;font-weight:700;color:#0ea5e9;">{{ number_format($stat->value) }}</span>
                        @if($stat->suffix)<span style="color:#64748b;font-size:.85rem;">{{ $stat->suffix }}</span>@endif
                    </td>
                    <td class="text-muted-c">{{ $stat->suffix ?? '—' }}</td>
                    <td>
                        @if($stat->icon)
                            <code style="font-size:.78rem;background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ $stat->icon }}</code>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($stat->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $stat->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.stats.edit', $stat) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-stat-{{ $stat->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.stats.destroy', $stat) }}', '{{ addslashes($stat->label) }}')"
                                    id="delete-stat-{{ $stat->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
                        <div class="empty-title">No stats yet</div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($stats->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $stats->links() }}</div>
    @endif
</div>
@endsection
