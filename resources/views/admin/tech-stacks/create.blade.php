@extends('admin.layouts.app')

@section('title', 'Add Technology')
@section('page-title', 'Add Technology')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.tech-stacks.index') }}">Tech Stacks</a><span class="breadcrumb-sep">/</span><span>Create</span></div>
        <h1 class="content-title">Add Technology</h1>
    </div>
    <a href="{{ route('admin.tech-stacks.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-6 col-md-8">
        <form action="{{ route('admin.tech-stacks.store') }}" method="POST" enctype="multipart/form-data" id="create-tech-form">
            @csrf
            <div class="admin-card">
                <div class="card-header-admin"><h3>Technology Details</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="name">Name <span class="required">*</span></label>
                        <input type="text" name="name" id="name" class="form-control-admin {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name') }}" required placeholder="e.g. Laravel">
                        @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="category">Category</label>
                        <select name="category" id="category" class="form-control-admin">
                            <option value="">— Select —</option>
                            @foreach(['Backend','Frontend','Database','DevOps','Tools','Security','Mobile','Cloud'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="logo">Logo Image</label>
                        <div class="upload-zone" onclick="document.getElementById('logo').click()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:26px;height:26px;"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                            <p><strong>Upload Logo</strong> — SVG, PNG — max 1MB</p>
                        </div>
                        <input type="file" name="logo" id="logo" accept="image/*,image/svg+xml" style="display:none"
                               onchange="if(this.files[0]){const r=new FileReader();r.onload=e=>{let i=document.getElementById('logo-preview');i.src=e.target.result;i.style.display='block';};r.readAsDataURL(this.files[0]);}">
                        <img id="logo-preview" src="" style="display:none;width:60px;height:60px;object-fit:contain;margin-top:8px;border:1px solid #e2e8f0;border-radius:8px;padding:4px;">
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="sort_order">Sort Order <span class="sort-hint ms-1">lower=first</span></label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control-admin" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group-admin" x-data="{ active: true }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Active / Visible</span>
                        </label>
                    </div>
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn-admin btn-primary-admin" id="create-tech-submit">Add Technology</button>
                        <a href="{{ route('admin.tech-stacks.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
