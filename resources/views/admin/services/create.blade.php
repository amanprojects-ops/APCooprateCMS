@extends('admin.layouts.app')

@section('title', 'Add Service')
@section('page-title', 'Add Service')
@section('page-subtitle', 'Create a new company service')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.services.index') }}">Services</a><span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <h1 class="content-title">Add New Service</h1>
    </div>
    <a href="{{ route('admin.services.index') }}" class="btn-admin btn-secondary-admin">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        Back
    </a>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" id="create-service-form">
    @csrf
    <div class="row g-3">

        {{-- Main Info --}}
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Basic Information</h3></div>
                <div class="card-body-admin">

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control-admin {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title') }}" placeholder="e.g. Web Development" required>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="slug">Slug
                            <span class="sort-hint ms-2">auto-generated if empty</span>
                        </label>
                        <input type="text" name="slug" id="slug" class="form-control-admin {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                               value="{{ old('slug') }}" placeholder="web-development">
                        @error('slug')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="icon">Icon Class / URL</label>
                        <input type="text" name="icon" id="icon" class="form-control-admin"
                               value="{{ old('icon') }}" placeholder="bi bi-code-slash or URL">
                        <div class="form-hint">Bootstrap icon class or full image URL for the service icon.</div>
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="short_description">Short Description <span class="required">*</span></label>
                        <textarea name="short_description" id="short_description" class="form-control-admin {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                                  rows="3" placeholder="Brief description shown in cards...">{{ old('short_description') }}</textarea>
                        @error('short_description')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="description">Full Description</label>
                        <textarea name="description" id="description" class="form-control-admin"
                                  rows="6" placeholder="Full service description with HTML support...">{{ old('description') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- SEO --}}
            <div class="admin-card">
                <div class="card-header-admin"><h3>SEO Meta</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control-admin"
                               value="{{ old('meta_title') }}" placeholder="SEO title (60 chars recommended)">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control-admin"
                                  rows="2" placeholder="SEO description (160 chars recommended)">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Options --}}
        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">

                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">
                            Sort Order
                            <span class="sort-hint ms-2">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="10" height="10"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                lower = first
                            </span>
                        </label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', 0) }}" min="0">
                    </div>

                    <div class="form-group-admin">
                        <label class="form-label-admin">Status</label>
                        <label class="toggle-wrapper" for="is_active_toggle">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active_toggle" value="1"
                                   {{ old('is_active', 1) ? 'checked' : '' }} style="display:none;"
                                   x-data x-ref="toggle">
                            <div class="toggle-track" :class="{ 'on': $el.previousElementSibling.previousElementSibling.checked }"
                                 @click="$el.previousElementSibling.previousElementSibling.checked = !$el.previousElementSibling.previousElementSibling.checked">
                                <div class="toggle-thumb"></div>
                            </div>
                            <span class="toggle-label">Active / Visible</span>
                        </label>
                    </div>

                </div>
            </div>

            {{-- Submit --}}
            <div class="admin-card">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-service-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                        </svg>
                        Create Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
