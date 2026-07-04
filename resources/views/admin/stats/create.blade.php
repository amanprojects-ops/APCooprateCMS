@extends('admin.layouts.app')

@section('title', 'Add Stat')
@section('page-title', 'Add Stat')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.stats.index') }}">Stats</a><span class="breadcrumb-sep">/</span><span>Create</span></div>
        <h1 class="content-title">Add Homepage Stat</h1>
    </div>
    <a href="{{ route('admin.stats.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-6 col-md-8">
        <form action="{{ route('admin.stats.store') }}" method="POST" id="create-stat-form">
            @csrf
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Stat Details</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="label">Label <span class="required">*</span></label>
                        <input type="text" name="label" id="label" class="form-control-admin" value="{{ old('label') }}"
                               required placeholder="e.g. Projects Completed">
                        @error('label')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-2">
                        <div class="col-md-7">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="value">Value <span class="required">*</span></label>
                                <input type="number" name="value" id="value" class="form-control-admin"
                                       value="{{ old('value', 0) }}" min="0" required placeholder="150">
                                @error('value')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="suffix">Suffix</label>
                                <input type="text" name="suffix" id="suffix" class="form-control-admin"
                                       value="{{ old('suffix') }}" placeholder="+ or K or %">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="icon">Icon Class</label>
                        <input type="text" name="icon" id="icon" class="form-control-admin"
                               value="{{ old('icon') }}" placeholder="bi-trophy or heroicon name">
                        <div class="form-hint">Bootstrap Icon class or icon name for display.</div>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order <span class="sort-hint ms-1">lower=first</span></label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: true }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Active / Visible</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn-admin btn-primary-admin" id="create-stat-submit">Add Stat</button>
                <a href="{{ route('admin.stats.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
