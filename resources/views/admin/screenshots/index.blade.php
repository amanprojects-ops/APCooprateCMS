@extends('admin.layouts.app')

@section('title', 'Manage Screenshots')
@section('page-title', 'Screenshots Gallery')
@section('page-subtitle', 'Manage all product and project screenshots')

@section('content')
<div class="content-header">
    <div>
        <div class="breadcrumb-admin"><a href="{{ route('admin.dashboard') }}">Dashboard</a><span class="breadcrumb-sep">/</span><span>Screenshots</span></div>
        <h1 class="content-title">Screenshots</h1>
        <p class="content-subtitle">Global gallery for products and projects</p>
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="button" class="btn-admin btn-secondary-admin" onclick="document.getElementById('importModal').showModal()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Import
        </button>
        <a href="{{ route('admin.screenshots.export') }}" class="btn-admin btn-secondary-admin">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
            Export
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Upload Form -->
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header-admin">
                <h3>Upload New Screenshot</h3>
            </div>
            <div class="card-body-admin">
                <form action="{{ route('admin.screenshots.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group-admin mb-3">
                        <label class="form-label-admin">Target Type</label>
                        <select name="target_type" class="form-control-admin" id="target_type" onchange="toggleTargets()" required>
                            <option value="">— Select Type —</option>
                            <option value="product">Product</option>
                            <option value="project">Project</option>
                        </select>
                    </div>

                    <div class="form-group-admin mb-3" id="product_select_group" style="display:none;">
                        <label class="form-label-admin">Select Product</label>
                        <select name="target_id" class="form-control-admin" id="product_target_id">
                            <option value="">— Select Product —</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-admin mb-3" id="project_select_group" style="display:none;">
                        <label class="form-label-admin">Select Project</label>
                        <select name="target_id" class="form-control-admin" id="project_target_id" disabled>
                            <option value="">— Select Project —</option>
                            @foreach($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group-admin mb-3">
                        <label class="form-label-admin">Image File</label>
                        <input type="file" name="image" class="form-control-admin" accept="image/*" required>
                    </div>

                    <div class="form-group-admin mb-3">
                        <label class="form-label-admin">Caption (Optional)</label>
                        <input type="text" name="caption" class="form-control-admin" placeholder="e.g. Dashboard View">
                    </div>

                    <button type="submit" class="btn-admin btn-primary-admin w-100">Upload Screenshot</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Gallery -->
    <div class="col-lg-8" x-data="deleteModal()">
        <!-- Products -->
        <div class="admin-card mb-4">
            <div class="card-header-admin">
                <h3>Product Screenshots ({{ $productScreenshots->count() }})</h3>
            </div>
            <div class="card-body-admin">
                @if($productScreenshots->count())
                <div class="row g-3">
                    @foreach($productScreenshots as $shot)
                    <div class="col-sm-6 col-md-4">
                        <div style="border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; position:relative; background:#fff;">
                            <img src="{{ Storage::url($shot->image_path) }}" alt="{{ $shot->caption }}" style="width:100%; height:120px; object-fit:cover;">
                            <div style="padding:8px; font-size:0.75rem;">
                                <strong style="display:block; margin-bottom:2px; color:#1e293b;">{{ $shot->product->name ?? 'Unknown' }}</strong>
                                <span style="color:#64748b;">{{ $shot->caption ?? 'No caption' }}</span>
                            </div>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    style="position:absolute; top:8px; right:8px; padding:4px 8px; border-radius:4px;"
                                    @click="confirm('{{ route('admin.product-screenshots.destroy', $shot) }}', 'this product screenshot')">✕</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted-c mb-0">No product screenshots uploaded yet.</p>
                @endif
            </div>
        </div>

        <!-- Projects -->
        <div class="admin-card">
            <div class="card-header-admin">
                <h3>Project Screenshots ({{ $projectScreenshots->count() }})</h3>
            </div>
            <div class="card-body-admin">
                @if($projectScreenshots->count())
                <div class="row g-3">
                    @foreach($projectScreenshots as $shot)
                    <div class="col-sm-6 col-md-4">
                        <div style="border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; position:relative; background:#fff;">
                            <img src="{{ Storage::url($shot->image_path) }}" alt="{{ $shot->caption }}" style="width:100%; height:120px; object-fit:cover;">
                            <div style="padding:8px; font-size:0.75rem;">
                                <strong style="display:block; margin-bottom:2px; color:#1e293b;">{{ $shot->project->title ?? 'Unknown' }}</strong>
                                <span style="color:#64748b;">{{ $shot->caption ?? 'No caption' }}</span>
                            </div>
                            <button type="button" class="btn-admin btn-danger-admin btn-xs-admin"
                                    style="position:absolute; top:8px; right:8px; padding:4px 8px; border-radius:4px;"
                                    @click="confirm('{{ route('admin.project-screenshots.destroy', $shot) }}', 'this project screenshot')">✕</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-muted-c mb-0">No project screenshots uploaded yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>


@include('admin.partials.import-modal', ['title' => 'Screenshots', 'route' => route('admin.screenshots.import')])
@push('scripts')
<script>
    function toggleTargets() {
        const type = document.getElementById('target_type').value;
        const productGroup = document.getElementById('product_select_group');
        const projectGroup = document.getElementById('project_select_group');
        const productSelect = document.getElementById('product_target_id');
        const projectSelect = document.getElementById('project_target_id');
        
        productGroup.style.display = 'none';
        projectGroup.style.display = 'none';
        productSelect.disabled = true;
        projectSelect.disabled = true;

        if (type === 'product') {
            productGroup.style.display = 'block';
            productSelect.disabled = false;
        } else if (type === 'project') {
            projectGroup.style.display = 'block';
            projectSelect.disabled = false;
        }
    }
</script>
@endpush
@endsection
