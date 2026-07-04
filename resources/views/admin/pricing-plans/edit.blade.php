@extends('admin.layouts.app')

@section('title', 'Edit Pricing Plan')
@section('page-title', 'Edit Pricing Plan')
@section('page-subtitle', $pricingPlan->name)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.pricing-plans.index') }}">Pricing Plans</a><span class="breadcrumb-sep">/</span>
            <span>Edit</span>
        </div>
        <h1 class="content-title">Edit: {{ $pricingPlan->name }}</h1>
    </div>
    <a href="{{ route('admin.pricing-plans.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.pricing-plans.update', $pricingPlan) }}" method="POST" id="edit-plan-form">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Plan Details</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="name">Plan Name <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control-admin"
                                       value="{{ old('name', $pricingPlan->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control-admin"
                                       value="{{ old('slug', $pricingPlan->slug) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tagline">Tagline</label>
                                <input type="text" name="tagline" id="tagline" class="form-control-admin"
                                       value="{{ old('tagline', $pricingPlan->tagline) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="price">Price ($) <span class="required">*</span></label>
                                <input type="number" name="price" id="price" class="form-control-admin"
                                       value="{{ old('price', $pricingPlan->price) }}" min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="billing_cycle">Billing Cycle</label>
                                <select name="billing_cycle" id="billing_cycle" class="form-control-admin">
                                    @foreach(['monthly','yearly','one-time'] as $cycle)
                                        <option value="{{ $cycle }}" {{ old('billing_cycle', $pricingPlan->billing_cycle) == $cycle ? 'selected' : '' }}>
                                            {{ ucfirst($cycle) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="badge_text">Badge Text</label>
                                <input type="text" name="badge_text" id="badge_text" class="form-control-admin"
                                       value="{{ old('badge_text', $pricingPlan->badge_text) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="cta_text">CTA Text</label>
                                <input type="text" name="cta_text" id="cta_text" class="form-control-admin"
                                       value="{{ old('cta_text', $pricingPlan->cta_text) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="cta_url">CTA URL</label>
                                <input type="url" name="cta_url" id="cta_url" class="form-control-admin"
                                       value="{{ old('cta_url', $pricingPlan->cta_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Features --}}
            <div class="admin-card"
                 x-data="featuresManager({{ json_encode($pricingPlan->features->map(fn($f) => ['text'=>$f->feature_text,'included'=>$f->is_included])->values()) }})">
                <div class="card-header-admin">
                    <h3>Plan Features</h3>
                    <button type="button" class="btn-admin btn-primary-admin btn-sm-admin" @click="addFeature()">+ Add Feature</button>
                </div>
                <div class="card-body-admin">
                    <template x-for="(feature, index) in features" :key="index">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                            <input type="checkbox" :name="`features[${index}][is_included]`" value="1"
                                   x-model="feature.included" style="accent-color:#0ea5e9;width:16px;height:16px;flex-shrink:0;">
                            <input type="text" :name="`features[${index}][text]`" x-model="feature.text"
                                   class="form-control-admin" :placeholder="`Feature ${index+1}`">
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin" @click="removeFeature(index)">✕</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $pricingPlan->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin"
                         x-data="{ active: {{ $pricingPlan->is_active?'true':'false' }}, featured: {{ $pricingPlan->is_featured?'true':'false' }} }">
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
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-plan-btn">Update Plan</button>
                    <a href="{{ route('admin.pricing-plans.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button" class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.pricing-plans.destroy', $pricingPlan) }}', '{{ addslashes($pricingPlan->name) }}')"
                            id="delete-plan-btn">Delete Plan</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function featuresManager(initial = []) {
    return {
        features: initial.length ? initial : [{ text: '', included: true }],
        addFeature() { this.features.push({ text: '', included: true }); },
        removeFeature(i) { this.features.splice(i, 1); }
    }
}
</script>
@endpush
@endsection
