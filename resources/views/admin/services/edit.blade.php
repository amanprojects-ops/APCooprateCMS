@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page-title', 'Edit Service')
@section('page-subtitle', $service->title)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.services.index') }}">Services</a><span class="breadcrumb-sep">/</span>
            <span>Edit</span>
        </div>
        <h1 class="content-title">Edit Service</h1>
    </div>
    <a href="{{ route('admin.services.index') }}" class="btn-admin btn-secondary-admin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Back
    </a>
</div>

<form action="{{ route('admin.services.update', $service) }}" method="POST" id="edit-service-form">
    @csrf
    @method('PUT')
    <div class="row g-3">

        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Basic Information</h3></div>
                <div class="card-body-admin">

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control-admin {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $service->title) }}" required>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control-admin"
                               value="{{ old('slug', $service->slug) }}">
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="icon">Icon</label>
                        <input type="text" name="icon" id="icon" class="form-control-admin"
                               value="{{ old('icon', $service->icon) }}" placeholder="bi bi-code-slash">
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="short_description">Short Description <span class="required">*</span></label>
                        <textarea name="short_description" id="short_description" class="form-control-admin" rows="3">{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="description">Full Description</label>
                        <textarea name="description" id="description" class="form-control-admin" rows="6">{{ old('description', $service->description) }}</textarea>
                    </div>

                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-admin"><h3>SEO Meta</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control-admin"
                               value="{{ old('meta_title', $service->meta_title) }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control-admin" rows="2">{{ old('meta_description', $service->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">
                            Sort Order
                            <span class="sort-hint ms-2">lower = first</span>
                        </label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $service->sort_order) }}" min="0">
                    </div>

                    <div class="form-group-admin" x-data="{ active: {{ $service->is_active ? 'true' : 'false' }} }">
                        <label class="form-label-admin">Status</label>
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }">
                                <div class="toggle-thumb"></div>
                            </div>
                            <span class="toggle-label" x-text="active ? 'Active' : 'Inactive'"></span>
                        </label>
                    </div>

                    <div style="padding-top:8px;border-top:1px solid #f1f5f9;font-size:.75rem;color:#64748b;">
                        Created {{ $service->created_at->format('M d, Y') }}<br>
                        Updated {{ $service->updated_at->diffForHumans() }}
                    </div>

                </div>
            </div>

            <div class="admin-card" x-data="deleteModal()">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-service-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                        </svg>
                        Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button"
                            class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.services.destroy', $service) }}', '{{ addslashes($service->title) }}')"
                            id="delete-service-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6"/>
                        </svg>
                        Delete Service
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>
@endsection
