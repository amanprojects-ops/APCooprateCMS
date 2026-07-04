@extends('admin.layouts.app')

@section('title', 'Inquiry #' . $contactInquiry->id)
@section('page-title', 'Contact Inquiry')
@section('page-subtitle', 'From ' . $contactInquiry->name)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.contact-inquiries.index') }}">Inquiries</a><span class="breadcrumb-sep">/</span>
            <span>#{{ $contactInquiry->id }}</span>
        </div>
        <h1 class="content-title">Inquiry #{{ $contactInquiry->id }}</h1>
    </div>
    <a href="{{ route('admin.contact-inquiries.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header-admin">
                <h3>Message</h3>
                @php
                    $badge = match($contactInquiry->status) {
                        'new'     => 'badge-accent',
                        'read'    => 'badge-info',
                        'replied' => 'badge-success',
                        'closed'  => 'badge-muted',
                        default   => 'badge-muted',
                    };
                @endphp
                <span class="badge-admin {{ $badge }}">{{ ucfirst($contactInquiry->status) }}</span>
            </div>
            <div class="card-body-admin">
                @if($contactInquiry->subject)
                    <div style="font-size:.9rem;font-weight:700;color:#0f172a;margin-bottom:14px;">
                        {{ $contactInquiry->subject }}
                    </div>
                @endif
                <div style="font-size:.9rem;line-height:1.8;color:#334155;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:16px;white-space:pre-line;">{{ $contactInquiry->message }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Sender Info --}}
        <div class="admin-card mb-3">
            <div class="card-header-admin"><h3>Sender Details</h3></div>
            <div class="card-body-admin">
                <dl style="margin:0;">
                    <dt style="font-size:.73rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">Name</dt>
                    <dd style="font-size:.9rem;font-weight:600;margin-bottom:10px;">{{ $contactInquiry->name }}</dd>

                    <dt style="font-size:.73rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">Email</dt>
                    <dd style="margin-bottom:10px;">
                        <a href="mailto:{{ $contactInquiry->email }}" style="color:#0ea5e9;text-decoration:none;font-size:.88rem;">
                            {{ $contactInquiry->email }}
                        </a>
                    </dd>

                    @if($contactInquiry->phone)
                    <dt style="font-size:.73rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">Phone</dt>
                    <dd style="margin-bottom:10px;font-size:.88rem;">{{ $contactInquiry->phone }}</dd>
                    @endif

                    @if($contactInquiry->service_interested)
                    <dt style="font-size:.73rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">Service Interested</dt>
                    <dd style="margin-bottom:10px;">
                        <span class="badge-admin badge-accent">{{ $contactInquiry->service_interested }}</span>
                    </dd>
                    @endif

                    <dt style="font-size:.73rem;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.05em;">Received</dt>
                    <dd style="font-size:.83rem;color:#64748b;margin-bottom:0;">
                        {{ $contactInquiry->created_at->format('M d, Y \a\t H:i') }}<br>
                        <span style="font-size:.72rem;">({{ $contactInquiry->created_at->diffForHumans() }})</span>
                    </dd>
                </dl>
            </div>
        </div>

        {{-- Status Update --}}
        <div class="admin-card mb-3">
            <div class="card-header-admin"><h3>Update Status</h3></div>
            <div class="card-body-admin">
                <form action="{{ route('admin.contact-inquiries.status', $contactInquiry) }}" method="POST" id="status-update-form">
                    @csrf @method('PATCH')
                    <div class="form-group-admin">
                        <select name="status" class="form-control-admin" id="status-select">
                            @foreach(['new','read','replied','closed'] as $s)
                                <option value="{{ $s }}" {{ $contactInquiry->status === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-status-btn">Update Status</button>
                </form>
            </div>
        </div>

        {{-- Quick Reply --}}
        <div class="admin-card mb-3">
            <div class="card-header-admin"><h3>Quick Reply</h3></div>
            <div class="card-body-admin">
                <a href="mailto:{{ $contactInquiry->email }}?subject=Re: {{ urlencode($contactInquiry->subject ?? 'Your Inquiry') }}"
                   class="btn-admin btn-success-admin w-100" id="reply-email-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Reply via Email
                </a>
            </div>
        </div>

        {{-- Delete --}}
        <div class="admin-card" x-data="deleteModal()">
            <div class="card-body-admin">
                <button type="button" class="btn-admin btn-danger-admin w-100"
                        @click="confirm('{{ route('admin.contact-inquiries.destroy', $contactInquiry) }}', 'Inquiry #{{ $contactInquiry->id }}')"
                        id="delete-inquiry-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                        <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6"/>
                    </svg>
                    Delete Inquiry
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
