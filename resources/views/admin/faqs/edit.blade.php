@extends('admin.layouts.app')

@section('title', 'Edit FAQ')
@section('page-title', 'Edit FAQ')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><a href="{{ route('admin.faqs.index') }}">FAQs</a><span class="breadcrumb-sep">/</span><span>Edit</span></div>
        <h1 class="content-title">Edit FAQ</h1>
    </div>
    <a href="{{ route('admin.faqs.index') }}" class="btn-admin btn-secondary-admin">← Back</a>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" id="edit-faq-form">
            @csrf @method('PUT')
            <div class="admin-card mb-3">
                <div class="card-header-admin"><h3>FAQ Content</h3></div>
                <div class="card-body-admin">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="question">Question <span class="required">*</span></label>
                        <input type="text" name="question" id="question" class="form-control-admin"
                               value="{{ old('question', $faq->question) }}" required>
                    </div>
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="answer">Answer <span class="required">*</span></label>
                        <textarea name="answer" id="answer" class="form-control-admin" rows="6" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="category">Category</label>
                                <select name="category" id="category" class="form-control-admin">
                                    <option value="">— None —</option>
                                    @foreach(['General','Services','Pricing','Technical','Support'] as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $faq->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-admin">
                                <label class="form-label-admin" for="sort_order">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control-admin"
                                       value="{{ old('sort_order', $faq->sort_order) }}" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-admin" x-data="{ active: {{ $faq->is_active ? 'true' : 'false' }} }">
                        <input type="hidden" name="is_active" :value="active ? 1 : 0">
                        <label class="toggle-wrapper" @click="active = !active">
                            <div class="toggle-track" :class="{ 'on': active }"><div class="toggle-thumb"></div></div>
                            <span class="toggle-label" x-text="active ? 'Active' : 'Inactive'"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="admin-card" x-data="deleteModal()">
                <div class="card-body-admin d-flex gap-2 flex-wrap align-items-center">
                    <button type="submit" class="btn-admin btn-primary-admin" id="update-faq-btn">Update FAQ</button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn-admin btn-secondary-admin">Cancel</a>
                    <button type="button" class="btn-admin btn-danger-admin ms-auto"
                            @click="confirm('{{ route('admin.faqs.destroy', $faq) }}', 'FAQ #{{ $faq->id }}')"
                            id="delete-faq-btn">Delete FAQ</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
