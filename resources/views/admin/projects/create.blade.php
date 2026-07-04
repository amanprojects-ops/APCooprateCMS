@extends('admin.layouts.app')

@section('title', 'Add Project')
@section('page-title', 'Add Project')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.projects.index') }}">Projects</a><span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <h1 class="content-title">Add New Project</h1>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="create-project-form">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Project Details</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" id="title" class="form-control-admin {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                       value="{{ old('title') }}" required>
                                @error('title')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_name">Client Name</label>
                                <input type="text" name="client_name" id="client_name" class="form-control-admin"
                                       value="{{ old('client_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug <span class="sort-hint ms-1">auto</span></label>
                                <input type="text" name="slug" id="slug" class="form-control-admin" value="{{ old('slug') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— Select —</option>
                                    @foreach(['Web','SaaS','Security','API','Mobile','Tool'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="description">Description <span class="required">*</span></label>
                                <textarea name="description" id="description" class="form-control-admin" rows="5"
                                          required>{{ old('description') }}</textarea>
                                @error('description')<div class="form-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="demo_url">Live Demo URL</label>
                                <input type="url" name="demo_url" id="demo_url" class="form-control-admin"
                                       value="{{ old('demo_url') }}" placeholder="https://...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="github_url">GitHub URL</label>
                                <input type="url" name="github_url" id="github_url" class="form-control-admin"
                                       value="{{ old('github_url') }}" placeholder="https://github.com/...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="completed_at">Completed Date</label>
                                <input type="date" name="completed_at" id="completed_at" class="form-control-admin"
                                       value="{{ old('completed_at') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="tech_stack_input">Tech Stack (comma-separated)</label>
                                <input type="text" id="tech_stack_input" class="form-control-admin"
                                       placeholder="Laravel, Vue.js, MySQL" value="{{ old('tech_stack_input') }}">
                                <input type="hidden" name="tech_stack[]" id="tech_stack_hidden">
                                <div class="form-hint">Separate with commas. e.g. Laravel, React, AWS</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Thumbnail</h3></div>
                <div class="card-body-admin">
                    <div class="upload-zone" onclick="document.getElementById('thumbnail').click()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9l4-4 4 4 4-4 4 4"/></svg>
                        <p><strong>Click to upload</strong> thumbnail<br>JPG, PNG, WebP — max 3MB</p>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none"
                           onchange="previewImg(this,'thumb-preview')">
                    <img id="thumb-preview" src="" alt="" style="display:none;margin-top:10px;width:100%;border-radius:8px;object-fit:cover;max-height:140px;">
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
                            <span class="toggle-label">Featured on Homepage</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-project-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        Create Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function previewImg(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Convert comma-separated tech stack to array
document.getElementById('create-project-form').addEventListener('submit', function() {
    const input = document.getElementById('tech_stack_input').value;
    const hidden = document.getElementById('tech_stack_hidden');
    hidden.name = '';
    if (input.trim()) {
        const tags = input.split(',').map(t => t.trim()).filter(t => t);
        tags.forEach(tag => {
            const field = document.createElement('input');
            field.type = 'hidden';
            field.name = 'tech_stack[]';
            field.value = tag;
            this.appendChild(field);
        });
    }
});
</script>
@endpush
@endsection
