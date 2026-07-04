@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('page-subtitle', $project->title)

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.projects.index') }}">Projects</a><span class="breadcrumb-sep">/</span>
            <span>Edit</span>
        </div>
        <h1 class="content-title">Edit: {{ Str::limit($project->title, 40) }}</h1>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" id="edit-project-form">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Project Details</h3></div>
                <div class="card-body-admin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                                <input type="text" name="title" id="title" class="form-control-admin"
                                       value="{{ old('title', $project->title) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="client_name">Client Name</label>
                                <input type="text" name="client_name" id="client_name" class="form-control-admin"
                                       value="{{ old('client_name', $project->client_name) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control-admin"
                                       value="{{ old('slug', $project->slug) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— Select —</option>
                                    @foreach(['Web','SaaS','Security','API','Mobile','Tool'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $project->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="description">Description <span class="required">*</span></label>
                                <textarea name="description" id="description" class="form-control-admin" rows="5"
                                          required>{{ old('description', $project->description) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="demo_url">Demo URL</label>
                                <input type="url" name="demo_url" id="demo_url" class="form-control-admin"
                                       value="{{ old('demo_url', $project->demo_url) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="github_url">GitHub URL</label>
                                <input type="url" name="github_url" id="github_url" class="form-control-admin"
                                       value="{{ old('github_url', $project->github_url) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="completed_at">Completed Date</label>
                                <input type="date" name="completed_at" id="completed_at" class="form-control-admin"
                                       value="{{ old('completed_at', $project->completed_at?->format('Y-m-d')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin">Tech Stack (comma-separated)</label>
                                <input type="text" id="tech_stack_input" class="form-control-admin"
                                       value="{{ old('tech_stack_input', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Screenshots --}}
            <div class="admin-card">
                <div class="card-header-admin">
                    <h3>Screenshots ({{ $project->screenshots->count() }})</h3>
                </div>
                <div class="card-body-admin">
                    @if($project->screenshots->count())
                    <div class="row g-2 mb-3">
                        @foreach($project->screenshots as $shot)
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
                                        @click="confirm('{{ route('admin.project-screenshots.destroy', $shot) }}', 'this screenshot')"
                                        id="del-shot-{{ $shot->id }}">✕</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- Add Screenshot --}}
                    <form action="{{ route('admin.projects.screenshots.store', $project) }}" method="POST" enctype="multipart/form-data">
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
                    @if($project->thumbnail)
                        <img src="{{ Storage::url($project->thumbnail) }}" alt="Current thumbnail"
                             style="width:100%;border-radius:8px;object-fit:cover;max-height:140px;margin-bottom:10px;">
                    @endif
                    <input type="file" name="thumbnail" class="form-control-admin" accept="image/*">
                    <div class="form-hint">Upload to replace current thumbnail.</div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                               value="{{ old('sort_order', $project->sort_order) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: {{ $project->is_active ? 'true' : 'false' }}, featured: {{ $project->is_featured ? 'true' : 'false' }} }">
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
                    <button type="submit" class="btn-admin btn-primary-admin w-100">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        Update Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button" class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.projects.destroy', $project) }}', '{{ addslashes($project->title) }}')"
                            id="delete-project-btn">Delete Project</button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('edit-project-form').addEventListener('submit', function() {
    const input = document.getElementById('tech_stack_input').value;
    if (input.trim()) {
        const tags = input.split(',').map(t => t.trim()).filter(t => t);
        const existing = this.querySelectorAll('input[name="tech_stack[]"]');
        existing.forEach(e => e.remove());
        tags.forEach(tag => {
            const field = document.createElement('input');
            field.type = 'hidden'; field.name = 'tech_stack[]'; field.value = tag;
            this.appendChild(field);
        });
    }
});
</script>
@endpush
@endsection
