@extends('admin.layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')
@section('page-subtitle', $product->name)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.products.index') }}">Products</a><span class="breadcrumb-sep">/</span><span>Edit</span></div>
        <h1 class="content-title">Edit: {{ Str::limit($product->name, 40) }}</h1>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="edit-product-form">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Product Information</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="name">Name <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form-control-admin"
                                       value="{{ old('name', $product->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control-admin"
                                       value="{{ old('slug', $product->slug) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tagline">Tagline</label>
                                <input type="text" name="tagline" id="tagline" class="form-control-admin"
                                       value="{{ old('tagline', $product->tagline) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— Select —</option>
                                    @foreach(['SaaS','Tool','API','Library','CLI','Dashboard','Plugin'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin">Tech Stack (comma-separated)</label>
                                <input type="text" id="tech_stack_input" class="form-control-admin"
                                       value="{{ old('tech_stack_input', is_array($product->tech_stack) ? implode(', ', $product->tech_stack) : '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control-admin" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="description">Full Description</label>
                                <textarea name="description" id="description" class="form-control-admin" rows="6">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="demo_url">Demo URL</label>
                                <input type="url" name="demo_url" id="demo_url" class="form-control-admin" value="{{ old('demo_url', $product->demo_url) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="docs_url">Docs URL</label>
                                <input type="url" name="docs_url" id="docs_url" class="form-control-admin" value="{{ old('docs_url', $product->docs_url) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="github_url">GitHub URL</label>
                                <input type="url" name="github_url" id="github_url" class="form-control-admin" value="{{ old('github_url', $product->github_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Screenshots --}}
            <div class="admin-card">
                <div class="card-header-admin">
                    <h3>Screenshots ({{ $product->screenshots->count() }})</h3>
                </div>
                <div class="card-body-admin">
                    @if($product->screenshots->count())
                    <div class="row g-2 mb-3">
                        @foreach($product->screenshots as $shot)
                        <div class="col-6 col-md-4" x-data="deleteModal()">
                            <div style="position:relative;border-radius:8px;overflow:hidden;border:1px solid #e2e8f0;">
                                <img src="{{ Storage::url($shot->image_path) }}" alt="{{ $shot->caption }}"
                                     style="width:100%;height:100px;object-fit:cover;">
                                @if($shot->caption)
                                    <div style="padding:4px 8px;font-size:.72rem;color:#64748b;background:#f8fafc;">{{ $shot->caption }}</div>
                                @endif
                                <button type="button"
                                        class="btn-admin btn-danger-admin btn-xs-admin"
                                        style="position:absolute;top:6px;right:6px;padding:4px 7px;"
                                        @click="confirm('{{ route('admin.product-screenshots.destroy', $shot) }}', 'this screenshot')"
                                        id="del-shot-{{ $shot->id }}">✕</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('admin.products.screenshots.store', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-7">
                                <input type="file" name="image" class="form-control-admin" accept="image/*" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="caption" class="form-control-admin" placeholder="Caption (optional)">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn-admin btn-success-admin w-100">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Thumbnail</h3></div>
                <div class="card-body-admin">
                    @if($product->thumbnail)
                        <img src="{{ Storage::url($product->thumbnail) }}" alt=""
                             style="width:100%;border-radius:8px;max-height:140px;object-fit:cover;margin-bottom:10px;">
                    @endif
                    <input type="file" name="thumbnail" class="form-control-admin" accept="image/*">
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $product->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin"
                         x-data="{ active: {{ $product->is_active?'true':'false' }}, featured: {{ $product->is_featured?'true':'false' }} }">
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
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-product-btn">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button" class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.products.destroy', $product) }}', '{{ addslashes($product->name) }}')"
                            id="delete-product-btn">Delete Product</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('edit-product-form').addEventListener('submit', function() {
    const input = document.getElementById('tech_stack_input').value;
    if (input.trim()) {
        this.querySelectorAll('input[name="tech_stack[]"]').forEach(e => e.remove());
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
