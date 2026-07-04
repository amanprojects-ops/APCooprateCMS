@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')
@section('page-subtitle', Str::limit($blogPost->title, 50))

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.blog-posts.index') }}">Blog Posts</a><span class="breadcrumb-sep">/</span>
            <span>Edit</span>
        </div>
        <h1 class="content-title">Edit Post</h1>
    </div>
    <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data" id="edit-post-form">
    @csrf @method('PUT')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Post Content</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control-admin"
                               value="{{ old('title', $blogPost->title) }}" required>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control-admin"
                               value="{{ old('slug', $blogPost->slug) }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control-admin" rows="2">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="content">Content <span class="required">*</span></label>
                        <textarea name="content" id="content" class="form-control-admin" rows="12" required>{{ old('content', $blogPost->content) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="admin-card">
                <div class="card-header-admin"><h3>SEO</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control-admin" value="{{ old('meta_title', $blogPost->meta_title) }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control-admin" rows="2">{{ old('meta_description', $blogPost->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Thumbnail</h3></div>
                <div class="card-body-admin">
                    @if($blogPost->thumbnail)
                        <img src="{{ Storage::url($blogPost->thumbnail) }}" alt=""
                             style="width:100%;border-radius:8px;max-height:130px;object-fit:cover;margin-bottom:10px;">
                    @endif
                    <input type="file" name="thumbnail" class="form-control-admin" accept="image/*">
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Details</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="category">Category</label>
                        <select name="category" id="category" class="form-control-admin">
                            <option value="">— None —</option>
                            @foreach(['Tutorial','Snippet','News','Security','DevOps','Review'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $blogPost->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="tags">Tags (comma-separated)</label>
                        <input type="text" name="tags" id="tags" class="form-control-admin"
                               value="{{ old('tags', is_array($blogPost->tags) ? implode(', ', $blogPost->tags) : '') }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="published_at">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control-admin"
                               value="{{ old('published_at', $blogPost->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                    <div style="font-size:.75rem;color:#64748b;margin-top:8px;">
                        Views: <strong>{{ number_format($blogPost->views) }}</strong><br>
                        Created: {{ $blogPost->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin"
                         x-data="{ published: {{ $blogPost->is_published ? 'true':'false' }}, featured: {{ $blogPost->is_featured ? 'true':'false' }} }">
                        <input type="hidden" name="is_published" :value="published ? 1 : 0">
                        <label class="toggle-wrapper mb-3" @click="published = !published">
                            <div class="toggle-track" :class="{ 'on': published }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="published ? 'Published' : 'Draft'"></span>
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
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="update-post-btn">Update Post</button>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                    <hr class="divider-admin">
                    <button type="button" class="btn-admin btn-danger-admin w-100"
                            @click="confirm('{{ route('admin.blog-posts.destroy', $blogPost) }}', '{{ addslashes($blogPost->title) }}')"
                            id="delete-post-btn">Delete Post</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
