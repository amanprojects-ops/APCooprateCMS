@extends('admin.layouts.app')

@section('title', 'Edit Technology')
@section('page-title', 'Edit Technology')
@section('page-subtitle', $techStack->name)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.tech-stacks.index') }}">Tech Stacks</a><span class="breadcrumb-sep">/</span><span>Edit</span></div>
        <h1 class="content-title">Edit Technology</h1>
    </div>
    <a href="{{ route('admin.tech-stacks.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-6 col-md-8">
        <form action="{{ route('admin.tech-stacks.update', $techStack) }}" method="POST" enctype="multipart/form-data" id="edit-tech-form">
            @csrf @method('PUT')
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Technology Details</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="name">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control-admin"
                               value="{{ old('name', $techStack->name) }}" required>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="category">Category</label>
                        <select name="category" id="category" class="form-control-admin">
                            <option value="">— Select —</option>
                            @foreach(['Backend','Frontend','Database','DevOps','Tools','Security','Mobile','Cloud'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $techStack->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin">Logo</label>
                        @if($techStack->logo)
                            <div style="margin-bottom:10px;">
                                <img src="{{ Storage::url($techStack->logo) }}" alt="{{ $techStack->name }}"
                                     style="width:60px;height:60px;object-fit:contain;border:1px solid #e2e8f0;border-radius:8px;padding:4px;">
                            </div>
                        @endif
                        <input type="file" name="logo" class="form-control-admin" accept="image/*,image/svg+xml">
                        <div class="form-hint">Upload to replace current logo.</div>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $techStack->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: {{ $techStack->is_active ? 'true' : 'false' }} }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="active ? 'Active' : 'Inactive'"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card" x-data="deleteModal()">
                <div class="card-body-admin d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn-admin btn-primary-admin" id="update-tech-btn">Update</button>
                    <a href="{{ route('admin.tech-stacks.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
                    <button type="button" class="btn-admin btn-danger-admin ms-auto"
                            @click="confirm('{{ route('admin.tech-stacks.destroy', $techStack) }}', '{{ addslashes($techStack->name) }}')"
                            id="delete-tech-btn">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
