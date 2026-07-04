@extends('admin.layouts.app')

@section('title', 'Create Pricing Plan')
@section('page-title', 'Create Pricing Plan')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.pricing-plans.index') }}">Pricing Plans</a><span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <h1 class="content-title">Create Pricing Plan</h1>
    </div>
    <a href="{{ route('admin.pricing-plans.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.pricing-plans.store') }}" method="POST" id="create-plan-form">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Plan Details</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="name">Plan Name <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control-admin" value="{{ old('name') }}" required>
                                @error('name')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control-admin" value="{{ old('slug') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tagline">Tagline</label>
                                <input type="text" name="tagline" id="tagline" class="form-control-admin" value="{{ old('tagline') }}" placeholder="Perfect for freelancers">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="price">Price ($) <span class="required">*</span></label>
                                <input type="number" name="price" id="price" class="form-control-admin" value="{{ old('price', 0) }}" min="0" step="0.01" required>
                                @error('price')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="billing_cycle">Billing Cycle <span class="required">*</span></label>
                                <select name="billing_cycle" id="billing_cycle" class="form-control-admin">
                                    <option value="monthly" {{ old('billing_cycle')=='monthly'?'selected':'' }}>Monthly</option>
                                    <option value="yearly"  {{ old('billing_cycle')=='yearly' ?'selected':'' }}>Yearly</option>
                                    <option value="one-time"{{ old('billing_cycle')=='one-time'?'selected':'' }}>One-time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="badge_text">Badge Text</label>
                                <input type="text" name="badge_text" id="badge_text" class="form-control-admin"
                                       value="{{ old('badge_text') }}" placeholder="Most Popular">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="cta_text">CTA Button Text <span class="required">*</span></label>
                                <input type="text" name="cta_text" id="cta_text" class="form-control-admin"
                                       value="{{ old('cta_text','Get Started') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="cta_url">CTA URL</label>
                                <input type="url" name="cta_url" id="cta_url" class="form-control-admin"
                                       value="{{ old('cta_url') }}" placeholder="https://...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Features --}}
            <div class="admin-card" x-data="featuresManager()">
                <div class="card-header-admin">
                    <h3>Plan Features</h3>
                    <button type="button" class="btn-admin btn-primary-admin btn-sm-admin" @click="addFeature()" id="add-feature-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="13" height="13"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Add Feature
                    </button>
                </div>
                <div class="card-body-admin">
                    <template x-for="(feature, index) in features" :key="index">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                            <input type="checkbox" :name="`features[${index}][is_included]`" value="1"
                                   x-model="feature.included" style="accent-color:#0ea5e9;width:16px;height:16px;flex-shrink:0;">
                            <input type="text" :name="`features[${index}][text]`"
                                   x-model="feature.text"
                                   class="form-control-admin"
                                   :placeholder="`Feature ${index+1}`"
                                   required>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin" @click="removeFeature(index)">✕</button>
                        </div>
                    </template>
                    <div x-show="features.length === 0" class="text-muted-c" style="font-size:.82rem;padding:8px 0;">
                        No features added. Click "Add Feature" to begin.
                    </div>
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
                            <span class="toggle-label">Featured Plan</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-plan-submit">Create Plan</button>
                    <a href="{{ route('admin.pricing-plans.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function featuresManager() {
    return {
        features: [{ text: '', included: true }],
        addFeature() { this.features.push({ text: '', included: true }); },
        removeFeature(i) { this.features.splice(i, 1); }
    }
}
</script>
@endpush
@endsection
