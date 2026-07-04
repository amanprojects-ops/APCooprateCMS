@extends('admin.layouts.app')

@section('title', 'Add FAQ')
@section('page-title', 'Add FAQ')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.faqs.index') }}">FAQs</a><span class="breadcrumb-sep">/</span><span>Create</span></div>
        <h1 class="content-title">Add New FAQ</h1>
    </div>
    <a href="{{ route('admin.faqs.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <form action="{{ route('admin.faqs.store') }}" method="POST" id="create-faq-form">
            @csrf
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>FAQ Content</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="question">Question <span class="required">*</span></label>
                        <input type="text" name="question" id="question" class="form-control-admin {{ $errors->has('question') ? 'is-invalid' : '' }}"
                               value="{{ old('question') }}" required placeholder="What is your refund policy?">
                        @error('question')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="answer">Answer <span class="required">*</span></label>
                        <textarea name="answer" id="answer" class="form-control-admin {{ $errors->has('answer') ? 'is-invalid' : '' }}"
                                  rows="6" required placeholder="Detailed answer...">{{ old('answer') }}</textarea>
                        @error('answer')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— None —</option>
                                    @foreach(['General','Services','Pricing','Technical','Support'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="sort_order">Sort Order <span class="sort-hint ms-1">lower=first</span></label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                                       value="{{ old('sort_order', 0) }}" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-admin" x-data="{ active: true }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label">Active / Visible</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn-admin btn-primary-admin" id="create-faq-submit">Add FAQ</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
