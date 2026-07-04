@extends('admin.layouts.auth')

@section('title', 'Admin Login')

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

    <h1 class="auth-heading">Welcome Back</h1>
    <p class="auth-subtext">Sign in to your admin dashboard</p>

    {{-- Flash Alert --}}
    @if(session('success'))
        <div class="auth-alert success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="auth-alert error">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Login Form --}}
    <form action="{{ route('admin.login.post') }}" method="POST" id="admin-login-form">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
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

        {{-- Password --}}
        <div class="mb-2" x-data="{ show: false }">
            <label for="password" class="auth-label">Password</label>
            <div style="position:relative;">
                <input :type="show ? 'text' : 'password'"
                       id="password"
                       name="password"
                       class="auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="••••••••"
                       autocomplete="current-password"
                       required>
                <button type="button"
                        @click="show = !show"
                        style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:rgba(255,255,255,.4);">
                    <svg x-show="!show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <svg x-show="show" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" x-cloak><path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                </button>
            </div>
        </div>

        {{-- Remember / Forgot --}}
        <div class="auth-form-footer">
            <label style="display:flex;align-items:center;gap:7px;cursor:pointer;">
                <input type="checkbox" name="remember" id="remember" style="accent-color:#0ea5e9;">
                <span style="font-size:.78rem;color:rgba(255,255,255,.55);">Remember me</span>
            </label>
            <a href="{{ route('admin.forgot-password') }}" class="auth-link">Forgot password?</a>
        </div>

        {{-- Submit --}}
        <button type="submit" class="auth-btn" id="login-submit-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Sign In to Admin Panel
        </button>
    </form>

    <p style="text-align:center;margin-top:20px;font-size:.75rem;color:rgba(255,255,255,.25);">
        AmanProjects CMS &copy; {{ date('Y') }}
    </p>

</div>
@endsection
