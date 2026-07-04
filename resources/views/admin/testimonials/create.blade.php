@extends('admin.layouts.app')

@section('title', 'Add Testimonial')
@section('page-title', 'Add Testimonial')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.testimonials.index') }}">Testimonials</a><span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <h1 class="content-title">Add Testimonial</h1>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" id="create-testimonial-form">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header-admin"><h3>Client & Review</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_name">Client Name <span class="required">*</span></label>
                                <input type="text" name="client_name" id="client_name" class="form-control-admin"
                                       value="{{ old('client_name') }}" required>
                                @error('client_name')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_designation">Designation</label>
                                <input type="text" name="client_designation" id="client_designation" class="form-control-admin"
                                       value="{{ old('client_designation') }}" placeholder="CEO, Developer...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_company">Company</label>
                                <input type="text" name="client_company" id="client_company" class="form-control-admin"
                                       value="{{ old('client_company') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin">Rating <span class="required">*</span></label>
                                <select name="rating" id="rating" class="form-control-admin">
                                    @for($i=5;$i>=1;$i--)
                                        <option value="{{ $i }}" {{ old('rating',5) == $i ? 'selected' : '' }}>
                                            {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5-$i) }} ({{ $i }}/5)
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="review">Review <span class="required">*</span></label>
                                <textarea name="review" id="review" class="form-control-admin" rows="5"
                                          required placeholder="Client's review text...">{{ old('review') }}</textarea>
                                @error('review')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Avatar</h3></div>
                <div class="card-body-admin">
                    <div class="upload-zone" onclick="document.getElementById('client_avatar').click()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:28px;height:28px;"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        <p><strong>Upload Avatar</strong><br>Max 1MB</p>
                    </div>
                    <input type="file" name="client_avatar" id="client_avatar" accept="image/*" style="display:none"
                           onchange="previewAvatar(this)">
                    <div id="avatar-preview-wrap" style="display:none;margin-top:10px;text-align:center;">
                        <img id="avatar-preview" style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid #0ea5e9;">
                    </div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: true, featured: false }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper mb-3" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Active</span>
                        </label>
                        <input type="hidden" name="is_featured" :value="featured ? 1 : 0">
                        <label class="toggle-wrapper" @click="featured = !featured">
                            <div class="toggle-track" :class="{ 'on': featured }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Featured</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-testimonial-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        Create Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('avatar-preview').src = e.target.result;
            document.getElementById('avatar-preview-wrap').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
