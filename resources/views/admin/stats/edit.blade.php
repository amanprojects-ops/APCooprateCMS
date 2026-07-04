@extends('admin.layouts.app')

@section('title', 'Edit Stat')
@section('page-title', 'Edit Stat')
@section('page-subtitle', $stat->label)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.stats.index') }}">Stats</a><span class="breadcrumb-sep">/</span><span>Edit</span></div>
        <h1 class="content-title">Edit Stat</h1>
    </div>
    <a href="{{ route('admin.stats.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-6 col-md-8">
        <form action="{{ route('admin.stats.update', $stat) }}" method="POST" id="edit-stat-form">
            @csrf @method('PUT')
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Stat Details</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="label">Label <span class="required">*</span></label>
                        <input type="text" name="label" id="label" class="form-control-admin"
                               value="{{ old('label', $stat->label) }}" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-7">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="value">Value <span class="required">*</span></label>
                                <input type="number" name="value" id="value" class="form-control-admin"
                                       value="{{ old('value', $stat->value) }}" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="suffix">Suffix</label>
                                <input type="text" name="suffix" id="suffix" class="form-control-admin"
                                       value="{{ old('suffix', $stat->suffix) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="icon">Icon</label>
                        <input type="text" name="icon" id="icon" class="form-control-admin"
                               value="{{ old('icon', $stat->icon) }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $stat->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: {{ $stat->is_active ? 'true' : 'false' }} }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="active ? 'Active' : 'Inactive'"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="admin-card" x-data="deleteModal()">
                <div class="card-body-admin d-flex gap-2 flex-wrap align-items-center">
                    <button type="submit" class="btn-admin btn-primary-admin" id="update-stat-btn">Update Stat</button>
                    <a href="{{ route('admin.stats.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
                    <button type="button" class="btn-admin btn-danger-admin ms-auto"
                            @click="confirm('{{ route('admin.stats.destroy', $stat) }}', '{{ addslashes($stat->label) }}')"
                            id="delete-stat-btn">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
