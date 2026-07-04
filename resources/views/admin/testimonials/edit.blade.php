@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('page-subtitle', $testimonial->client_name)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.testimonials.index') }}">Testimonials</a><span class="breadcrumb-sep">/</span>
            <span>Edit</span>
        </div>
        <h1 class="content-title">Edit Testimonial</h1>
    </div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" id="edit-testimonial-form">
    @csrf @method('PUT')
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
                                       value="{{ old('client_name', $testimonial->client_name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_designation">Designation</label>
                                <input type="text" name="client_designation" id="client_designation" class="form-control-admin"
                                       value="{{ old('client_designation', $testimonial->client_designation) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_company">Company</label>
                                <input type="text" name="client_company" id="client_company" class="form-control-admin"
                                       value="{{ old('client_company', $testimonial->client_company) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin">Rating</label>
                                <select name="rating" id="rating" class="form-control-admin">
                                    @for($i=5;$i>=1;$i--)
                                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                                            {{ str_repeat('★', $i) }}{{ str_repeat('☆', 5-$i) }} ({{ $i }}/5)
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="review">Review <span class="required">*</span></label>
                                <textarea name="review" id="review" class="form-control-admin" rows="5" required>{{ old('review', $testimonial->review) }}</textarea>
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
                    @if($testimonial->client_avatar)
                        <div style="text-align:center;margin-bottom:10px;">
                            <img src="{{ Storage::url($testimonial->client_avatar) }}" alt="Avatar"
                                 style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid #0ea5e9;">
                        </div>
                    @endif
                    <input type="file" name="client_avatar" class="form-control-admin" accept="image/*">
                    <div class="form-hint">Upload to replace current avatar.</div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $testimonial->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: {{ $testimonial->is_active ? 'true':'false' }}, featured: {{ $testimonial->is_featured ? 'true':'false' }} }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper mb-3" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="active ? 'Active' : 'Inactive'"></span>
                        </label>
                        <input type="hidden" name="is_featured" :value="featured ? 1 : 0">
                        <label class="toggle-wrapper" @click="featured = !featured">
                            <div class="toggle-track" :class="{ 'on': featured }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="featured ? 'Featured' : 'Not Featured'"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card" x-data="deleteModal()">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-testimonial-btn">Update Testimonial</button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button" class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.testimonials.destroy', $testimonial) }}', '{{ addslashes($testimonial->client_name) }}')"
                            id="delete-testimonial-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
