@extends('admin.layouts.app')

@section('title', 'Add Product')
@section('page-title', 'Add Product')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.products.index') }}">Products</a><span class="breadcrumb-sep">/</span><span>Create</span></div>
        <h1 class="content-title">Add New Product</h1>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="create-product-form">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Product Information</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="name">Name <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control-admin {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       value="{{ old('name') }}" required>
                                @error('name')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug <span class="sort-hint ms-1">auto</span></label>
                                <input type="text" name="slug" id="slug" class="form-control-admin" value="{{ old('slug') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tagline">Tagline</label>
                                <input type="text" name="tagline" id="tagline" class="form-control-admin"
                                       value="{{ old('tagline') }}" placeholder="One-line value proposition">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— Select —</option>
                                    @foreach(['SaaS','Tool','API','Library','CLI','Dashboard','Plugin'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tech_stack_input">Tech Stack (comma-separated)</label>
                                <input type="text" id="tech_stack_input" class="form-control-admin"
                                       value="{{ old('tech_stack_input') }}" placeholder="Laravel, Vue.js, MySQL">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control-admin" rows="2">{{ old('short_description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="description">Full Description</label>
                                <textarea name="description" id="description" class="form-control-admin" rows="6">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="demo_url">Demo URL</label>
                                <input type="url" name="demo_url" id="demo_url" class="form-control-admin"
                                       value="{{ old('demo_url') }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="docs_url">Docs URL</label>
                                <input type="url" name="docs_url" id="docs_url" class="form-control-admin"
                                       value="{{ old('docs_url') }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="github_url">GitHub URL</label>
                                <input type="url" name="github_url" id="github_url" class="form-control-admin"
                                       value="{{ old('github_url') }}" placeholder="https://github.com/...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-admin"><h3>SEO</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control-admin" value="{{ old('meta_title') }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control-admin" rows="2">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Thumbnail</h3></div>
                <div class="card-body-admin">
                    <div class="upload-zone" onclick="document.getElementById('thumbnail').click()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:26px;height:26px;"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                        <p><strong>Upload Thumbnail</strong><br>Max 2MB</p>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none"
                           onchange="if(this.files[0]){const r=new FileReader();r.onload=e=>{let i=document.getElementById('thumb-preview');i.src=e.target.result;i.style.display='block';};r.readAsDataURL(this.files[0]);}">
                    <img id="thumb-preview" src="" style="display:none;width:100%;margin-top:10px;border-radius:8px;max-height:140px;object-fit:cover;">
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order <span class="sort-hint ms-1">lower=first</span></label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin" value="{{ old('sort_order', 0) }}" min="0">
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
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-product-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        Create Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('create-product-form').addEventListener('submit', function() {
    const input = document.getElementById('tech_stack_input').value;
    if (input.trim()) {
        input.split(',').map(t => t.trim()).filter(t => t).forEach(tag => {
            const f = document.createElement('input');
            f.type = 'hidden'; f.name = 'tech_stack[]'; f.value = tag;
            this.appendChild(f);
        });
    }
});
</script>
@endpush
@endsection
