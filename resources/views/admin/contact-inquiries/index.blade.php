@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')
@section('page-title', 'Contact Inquiries')
@section('page-subtitle', 'Incoming messages from visitors')

@section('content')

{{-- Status Filter Tabs --}}
<div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap;">
    @php $activeStatus = request('status',''); @endphp
    <a href="{{ route('admin.contact-inquiries.index') }}"
       class="btn-admin btn-sm-admin {{ $activeStatus==='' ? 'btn-primary-admin' : 'btn-secondary-admin' }}" id="filter-all">
        All <span class="badge-admin badge-muted ms-1">{{ $counts['all'] }}</span>
    </a>
    @foreach(['new'=>'badge-accent','read'=>'badge-info','replied'=>'badge-success','closed'=>'badge-muted'] as $s => $b)
    <a href="{{ route('admin.contact-inquiries.index', ['status'=>$s]) }}"
       class="btn-admin btn-sm-admin {{ $activeStatus===$s ? 'btn-primary-admin' : 'btn-secondary-admin' }}" id="filter-{{ $s }}">
        {{ ucfirst($s) }} <span class="badge-admin {{ $b }} ms-1">{{ $counts[$s] }}</span>
    </a>
    @endforeach
</div>

<div class="admin-card" x-data="deleteModal()">
    <div class="table-responsive-admin">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>From</th>
                    <th>Subject</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inq)
                <tr style="{{ $inq->status==='new' ? 'background:#f0f9ff;font-weight:500;' : '' }}">
                    <td class="text-muted-c" style="font-size:.78rem;">{{ $inq->id }}</td>
                    <td>
                        <div class="fw-600" style="font-size:.83rem;">{{ $inq->name }}</div>
                        <a href="mailto:{{ $inq->email }}" style="font-size:.73rem;color:#0ea5e9;text-decoration:none;">{{ $inq->email }}</a>
                        @if($inq->phone)
                            <div style="font-size:.72rem;color:#64748b;">{{ $inq->phone }}</div>
                        @endif
                    </td>
                    <td class="truncate" style="max-width:180px;">{{ $inq->subject ?? 'No Subject' }}</td>
                    <td style="font-size:.8rem;color:#64748b;">{{ $inq->service_interested ?? '—' }}</td>
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
                    <td style="font-size:.78rem;color:#64748b;">{{ $inq->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.contact-inquiries.show', $inq) }}"
                               class="btn-admin btn-secondary-admin btn-xs-admin" id="view-inq-{{ $inq->id }}">View</a>
                            <button type="button"
                                    class="btn-admin btn-danger-admin btn-xs-admin"
                                    @click="confirm('{{ route('admin.contact-inquiries.destroy', $inq) }}', '#{{ $inq->id }}')"
                                    id="delete-inq-{{ $inq->id }}">Del</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg></div>
                        <div class="empty-title">No inquiries found</div>
                    </div>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inquiries->hasPages())
    <div style="padding:12px 20px;border-top:1px solid #e2e8f0;">{{ $inquiries->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
