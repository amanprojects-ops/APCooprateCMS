@extends('admin.layouts.app')

@section('title', 'Pricing Plans')
@section('page-title', 'Pricing Plans')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Pricing Plans</span></div>
        <h1 class="content-title">Pricing Plans</h1>
    </div>
    <a href="{{ route('admin.pricing-plans.create') }}" class="btn-admin btn-primary-admin" id="add-plan-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Plan
    </a>
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Billing</th>
                    <th>Features</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans as $plan)
                <tr>
                    <td>
                        <div class="fw-600">{{ $plan->name }}</div>
                        @if($plan->tagline)<div style="font-size:.73rem;color:#64748b;">{{ $plan->tagline }}</div>@endif
                        @if($plan->badge_text)<span class="badge-admin badge-warning">{{ $plan->badge_text }}</span>@endif
                    </td>
                    <td>
                        <span class="fw-700" style="font-size:1rem;color:#0ea5e9;">${{ number_format($plan->price, 2) }}</span>
                    </td>
                    <td>
                        @php
                            $badges = ['monthly'=>'badge-info','yearly'=>'badge-success','one-time'=>'badge-accent'];
                        @endphp
                        <span class="badge-admin {{ $badges[$plan->billing_cycle] ?? 'badge-muted' }}">{{ ucfirst($plan->billing_cycle) }}</span>
                    </td>
                    <td><span class="badge-admin badge-muted">{{ $plan->features_count }} features</span></td>
                    <td>
                        @if($plan->is_featured)
                            <span class="badge-admin badge-warning">⭐ Yes</span>
                        @else
                            <span class="text-muted-c">—</span>
                        @endif
                    </td>
                    <td>
                        @if($plan->is_active)
                            <span class="badge-admin badge-success"><span class="status-dot active"></span> Active</span>
                        @else
                            <span class="badge-admin badge-muted">Inactive</span>
                        @endif
                    </td>
                    <td class="text-muted-c">{{ $plan->sort_order }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.pricing-plans.edit', $plan) }}" class="btn-admin btn-secondary-admin btn-xs-admin" id="edit-plan-{{ $plan->id }}">Edit</a>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.pricing-plans.destroy', $plan) }}', '{{ addslashes($plan->name) }}')"
                                    id="delete-plan-{{ $plan->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
                        <div class="empty-title">No pricing plans yet</div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($plans->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $plans->links() }}</div>
    @endif
</div>
@endsection
