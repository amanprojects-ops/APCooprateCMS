@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('page-subtitle', 'Manage global configuration')

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
    @csrf

    @foreach($settings as $group => $groupSettings)
    <div class="admin-card mb-4">
        <div class="card-header-admin">
            <h3 style="text-transform:capitalize;">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" width="16" height="16" style="margin-right:6px;">
                    <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M20 12h2M2 12h2"/>
                </svg>
                {{ ucfirst($group) }} Settings
            </h3>
            <span class="badge-admin badge-muted">{{ $groupSettings->count() }} keys</span>
        </div>
        <div class="card-body-admin">
            <div class="row g-3">
                @foreach($groupSettings as $setting)
                <div class="col-md-6">
                    <div class="form-group-admin">
                        <label class="form-label-admin" for="setting_{{ $setting->key }}">
                            {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                            <span class="sort-hint ms-2">{{ $setting->type }}</span>
                        </label>

                        @if($setting->type === 'textarea')
                            <textarea name="{{ $setting->key }}"
                                      id="setting_{{ $setting->key }}"
                                      class="form-control-admin"
                                      rows="3">{{ old($setting->key, $setting->value) }}</textarea>

                        @elseif($setting->type === 'url')
                            <input type="url"
                                   name="{{ $setting->key }}"
                                   id="setting_{{ $setting->key }}"
                                   class="form-control-admin"
                                   value="{{ old($setting->key, $setting->value) }}"
                                   placeholder="https://...">

                        @elseif($setting->type === 'image')
                            <div x-data="{ 
                                previewUrl: '{{ $setting->value ? Storage::url($setting->value) : '' }}',
                                handleFileChange(event) {
                                    const file = event.target.files[0];
                                    if (file) {
                                        this.previewUrl = URL.createObjectURL(file);
                                    }
                                }
                            }">
                                <template x-if="previewUrl">
                                    <div class="mb-2 d-flex align-items-center gap-3">
                                        <img :src="previewUrl" alt="{{ $setting->key }}" style="max-height:80px;border-radius:6px;border:1px solid #e2e8f0;padding:4px;background:#f8fafc;">
                                        @if($setting->value)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_image[{{ $setting->key }}]" id="remove_{{ $setting->key }}" value="1">
                                                <label class="form-check-label text-danger" for="remove_{{ $setting->key }}" style="font-size:0.875rem;cursor:pointer;">
                                                    Remove image
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </template>
                                <input type="file"
                                       name="{{ $setting->key }}"
                                       id="setting_{{ $setting->key }}"
                                       class="form-control-admin"
                                       accept="image/*{{ $setting->key === 'favicon' ? ',.ico' : '' }}"
                                       @change="handleFileChange">
                            </div>

                        @else
                            <input type="text"
                                   name="{{ $setting->key }}"
                                   id="setting_{{ $setting->key }}"
                                   class="form-control-admin"
                                   value="{{ old($setting->key, $setting->value) }}"
                                   placeholder="Enter value...">
                        @endif

                        @error($setting->key)
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    @if($settings->isEmpty())
        <div class="admin-card">
            <div class="card-body-admin">
                <div class="empty-state">
                    <div class="empty-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/></svg></div>
                    <div class="empty-title">No settings found</div>
                    <div class="empty-text">Run the settings seeder to populate default configuration values.</div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex gap-2">
            <button type="submit" class="btn-admin btn-primary-admin" id="save-settings-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                </svg>
                Save All Settings
            </button>
            <button type="reset" class="btn-admin btn-secondary-admin">Reset</button>
        </div>
    @endif
</form>
@endsection
