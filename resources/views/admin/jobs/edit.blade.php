@extends('essentials.admin_navbar')
@section('title', 'Edit Job')
@section('crumb', 'Jobs / Edit')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">{{ $job->title }}</h1>
        <p class="adm-page-sub">
            Last updated {{ $job->updated_at->diffForHumans() }} ·
            Posted {{ $job->posted_on ? $job->posted_on->format('Y-m-d') : '—' }}
        </p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.jobs.index') }}" class="adm-btn"><i class="ri-arrow-left-line"></i> Back to jobs</a>
    </div>
</div>

@if($errors->any())
<div class="adm-alert is-danger">
    <span class="adm-alert-title"><i class="ri-error-warning-line"></i> Please fix the following:</span>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="adm-form-layout">
        <div>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Role</h2></div>
                <div class="adm-card-body">
                    <div class="adm-grid-2">
                        <div class="adm-field">
                            <label class="adm-label" for="title">
                                <i class="ri-briefcase-line"></i> Job title <span class="adm-req">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="adm-input" required
                                   value="{{ old('title', $job->title) }}">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="title_ja">
                                <i class="ri-translate-2"></i> Job title <span class="adm-opt">日本語</span>
                            </label>
                            <input type="text" name="title_ja" id="title_ja" class="adm-input"
                                   value="{{ old('title_ja', $job->title_ja) }}" placeholder="日本語の職種名（任意）">
                            <p class="adm-hint">Optional. Falls back to the English title if blank.</p>
                        </div>
                    </div>

                    <div class="adm-grid-2">
                        <div class="adm-field">
                            <label class="adm-label" for="country">
                                <i class="ri-map-pin-line"></i> Country <span class="adm-req">*</span>
                            </label>
                            <input type="text" name="country" id="country" class="adm-input" required
                                   value="{{ old('country', $job->country) }}">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="positions_left">
                                <i class="ri-team-line"></i> Available positions <span class="adm-req">*</span>
                            </label>
                            <input type="number" name="positions_left" id="positions_left" class="adm-input"
                                   required min="0" value="{{ old('positions_left', $job->positions_left) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">
                    <h2 class="adm-card-title">Description</h2>
                    <span class="adm-card-meta">Shown on the job detail page</span>
                </div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="description">
                            <i class="ri-file-text-line"></i> Job description <span class="adm-req">*</span>
                        </label>
                        <textarea name="description" id="summernote" rows="10" class="adm-textarea" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="description_ja">
                            <i class="ri-translate-2"></i> Job description <span class="adm-opt">日本語</span>
                        </label>
                        <textarea name="description_ja" id="summernote_ja" rows="10" class="adm-textarea">{{ old('description_ja', $job->description_ja) }}</textarea>
                        <p class="adm-hint">Optional. Falls back to the English description if blank.</p>
                    </div>
                </div>
            </div>
        </div>

        <aside>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Placement</h2></div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="is_featured">
                            <i class="ri-star-line"></i> Featured job <span class="adm-req">*</span>
                        </label>
                        <select name="is_featured" id="is_featured" class="adm-select" required>
                            <option value="1" {{ old('is_featured', $job->is_featured) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_featured', $job->is_featured) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        <p class="adm-hint">Featured jobs appear on the homepage.</p>
                    </div>

                    <div class="adm-field" id="featured_order_group">
                        <label class="adm-label" for="featured_order">
                            <i class="ri-list-ordered"></i> Featured order
                        </label>
                        <input type="number" name="featured_order" id="featured_order" class="adm-input" min="1"
                               value="{{ old('featured_order') }}" placeholder="1 = highest">
                    </div>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head"><h2 class="adm-card-title">Image</h2></div>
                <div class="adm-card-body">
                    @if($job->image_path)
                        <img src="{{ asset('storage/' . $job->image_path) }}" alt=""
                             class="adm-preview-img is-wide" style="margin-bottom:12px;">
                    @endif
                    <div class="adm-field">
                        <label class="adm-label" for="image">
                            <i class="ri-image-line"></i> Replace image
                        </label>
                        <input type="file" name="image" id="image" class="adm-input" accept="image/*"
                               onchange="admPreviewImage(this, 'preview_image')">
                        <p class="adm-hint">Leave empty to keep the current image.</p>
                        <div id="preview_image" class="adm-image-preview"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <div class="adm-actionbar">
        <span class="adm-actionbar-note">Last updated {{ $job->updated_at->diffForHumans() }}.</span>
        <a href="{{ route('admin.jobs.index') }}" class="adm-btn">Cancel</a>
        <button type="submit" class="adm-btn is-primary"><i class="ri-save-line"></i> Update job</button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var isFeatured = document.getElementById('is_featured');
        var orderGroup = document.getElementById('featured_order_group');
        if (isFeatured && orderGroup) {
            var sync = function () {
                orderGroup.style.display = isFeatured.value == 1 ? 'block' : 'none';
            };
            isFeatured.addEventListener('change', sync);
            sync();
        }
    });

    function admPreviewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        if (!preview) return;
        preview.innerHTML = '';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                preview.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
