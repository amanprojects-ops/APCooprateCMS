@extends('admin.layouts.auth')

@section('title', 'Check Your Email')

@section('content')
<div class="auth-card" style="text-align:center;">

    {{-- Icon --}}
    <div style="width:64px;height:64px;background:linear-gradient(135deg,rgba(14,165,233,.2),rgba(14,165,233,.05));border:1px solid rgba(14,165,233,.3);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
        <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="1.8" width="28" height="28">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
        </svg>
    </div>

    <h1 class="auth-heading">Check Your Email</h1>
    <p class="auth-subtext" style="margin-bottom:24px;">
        We've sent a password reset link to your registered email address. Please check your inbox and follow the instructions.
    </p>

    @if(session('info'))
        <div class="auth-alert info" style="text-align:left;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('info') }}
        </div>
    @endif

    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:8px;padding:14px;margin-bottom:22px;text-align:left;">
        <p style="font-size:.78rem;color:rgba(255,255,255,.45);margin:0;line-height:1.7;">
            ✉️ Didn't receive the email? Check your spam folder.<br>
            🔁 You can request a new link if it expires.<br>
            🔒 The link is valid for <strong style="color:rgba(255,255,255,.65);">60 minutes</strong>.
        </p>
    </div>

    <a href="{{ route('admin.forgot-password') }}" class="auth-btn" style="margin-bottom:12px;" id="resend-link-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
            <polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 102.13-9.36L1 10"/>
        </svg>
        Resend Reset Link
    </a>

    <a href="{{ route('admin.login') }}" class="auth-btn"
       style="background:rgba(255,255,255,.05);box-shadow:none;border:1px solid rgba(255,255,255,.08);"
       id="back-to-login-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
        Back to Login
    </a>

</div>
@endsection
