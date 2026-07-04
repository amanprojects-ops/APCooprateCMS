@extends('admin.layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="auth-card">

    {{-- Logo --}}
    <div class="auth-logo">
        <div class="auth-logo-icon">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <div class="auth-logo-text">AmanProjects</div>
    </div>

    <h1 class="auth-heading">Forgot Password?</h1>
    <p class="auth-subtext">Enter your email and we'll send you a reset link</p>

    {{-- Flash Alerts --}}
    @if(session('info'))
        <div class="auth-alert info">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ session('info') }}
        </div>
    @endif
    @if($errors->any())
        <div class="auth-alert error">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.forgot-password.post') }}" method="POST" id="forgot-password-form">
        @csrf

        <div class="mb-4">
            <label for="email" class="auth-label">Email Address</label>
            <input type="email"
                   id="email"
                   name="email"
                   class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   placeholder="admin@example.com"
                   value="{{ old('email') }}"
                   autocomplete="email"
                   required>
        </div>

        <button type="submit" class="auth-btn" id="forgot-submit-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            Send Reset Link
        </button>

        <div class="auth-divider">or</div>

        <a href="{{ route('admin.login') }}" class="auth-btn"
           style="background:rgba(255,255,255,.06);box-shadow:none;border:1px solid rgba(255,255,255,.1);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
            </svg>
            Back to Login
        </a>
    </form>

</div>
@endsection
