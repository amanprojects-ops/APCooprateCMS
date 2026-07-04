@extends('admin.layouts.app')

@section('title', 'Write Blog Post')
@section('page-title', 'Write Blog Post')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span>
            <a href="{{ route('admin.blog-posts.index') }}">Blog Posts</a><span class="breadcrumb-sep">/</span>
            <span>Create</span>
        </div>
        <h1 class="content-title">Write New Post</h1>
    </div>
    <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data" id="create-post-form">
    @csrf
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Post Content</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="title">Title <span class="required">*</span></label>
                        <input type="text" name="title" id="title" class="form-control-admin {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title') }}" required placeholder="Post title...">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="slug">Slug <span class="sort-hint ms-1">auto</span></label>
                        <input type="text" name="slug" id="slug" class="form-control-admin" value="{{ old('slug') }}">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control-admin" rows="2"
                                  placeholder="Short summary for listing pages...">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="content">Content <span class="required">*</span></label>
                        <textarea name="content" id="content" class="form-control-admin {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                  rows="12" required placeholder="Write your post content here. HTML is supported.">{{ old('content') }}</textarea>
                        @error('content')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-hint">HTML content is supported. You can integrate a rich text editor (TinyMCE / Quill) with this textarea.</div>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:26px;height:26px;"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9l4-4 4 4 4-4 4 4"/><path d="M3 15l5 5 4-4 5 5"/></svg>
                        <p><strong>Upload Thumbnail</strong><br>Max 3MB</p>
                    </div>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none"
                           onchange="if(this.files[0]){const r=new FileReader();r.onload=e=>{let i=document.getElementById('thumb-preview');i.src=e.target.result;i.style.display='block';};r.readAsDataURL(this.files[0]);}">
                    <img id="thumb-preview" src="" style="display:none;width:100%;margin-top:10px;border-radius:8px;max-height:140px;object-fit:cover;">
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
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="tags">Tags <span class="sort-hint ms-1">comma-separated</span></label>
                        <input type="text" name="tags" id="tags" class="form-control-admin"
                               value="{{ old('tags') }}" placeholder="laravel, php, api">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="published_at">Publish Date</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control-admin"
                               value="{{ old('published_at') }}">
                        <div class="form-hint">Leave empty to use now when publishing.</div>
                    </div>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>Options</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin" x-data="{ published: false, featured: false }">
                        <input type="hidden" name="is_published" :value="published ? 1 : 0">
                        <label class="toggle-wrapper mb-3" @click="published = !published">
                            <div class="toggle-track" :class="{ 'on': published }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="published ? 'Published' : 'Draft'"></span>
                        </label>
                        <input type="hidden" name="is_featured" :value="featured ? 1 : 0">
                        <label class="toggle-wrapper" @click="featured = !featured">
                            <div class="toggle-track" :class="{ 'on': featured }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Featured Post</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-body-admin">
                    <button type="submit" class="btn-admin btn-primary-admin w-100" id="create-post-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                        Save Post
                    </button>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn-admin btn-secondary-admin w-100 mt-2">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
