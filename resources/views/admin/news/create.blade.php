@extends('essentials.admin_navbar')
@section('title', 'Add News')
@section('crumb', 'News / New')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">New article</h1>
        <p class="adm-page-sub">Save as a draft, or publish straight to the website.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.news.index') }}" class="adm-btn"><i class="ri-arrow-left-line"></i> Back to news</a>
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

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="adm-form-layout">
        <div>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Headline</h2></div>
                <div class="adm-card-body">
                    <div class="adm-grid-2">
                        <div class="adm-field">
                            <label class="adm-label" for="title">
                                <i class="ri-newspaper-line"></i> News title <span class="adm-req">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="adm-input" required
                                   value="{{ old('title') }}" placeholder="Enter news title">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="title_ja">
                                <i class="ri-translate-2"></i> News title <span class="adm-opt">日本語</span>
                            </label>
                            <input type="text" name="title_ja" id="title_ja" class="adm-input"
                                   value="{{ old('title_ja') }}" placeholder="日本語のタイトル（任意）">
                            <p class="adm-hint">Optional. Falls back to the English title if blank.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head"><h2 class="adm-card-title">Content</h2></div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="content">
                            <i class="ri-file-text-line"></i> Content <span class="adm-req">*</span>
                        </label>
                        <textarea name="content" id="summernote" class="adm-textarea" required rows="6">{{ old('content') }}</textarea>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="content_ja">
                            <i class="ri-translate-2"></i> Content <span class="adm-opt">日本語</span>
                        </label>
                        <textarea name="content_ja" id="summernote_ja" class="adm-textarea" rows="6">{{ old('content_ja') }}</textarea>
                        <p class="adm-hint">Optional. Falls back to the English content if blank.</p>
                    </div>
                </div>
            </div>
        </div>

        <aside>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Publishing</h2></div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="posted_on">
                            <i class="ri-calendar-line"></i> Posted date
                        </label>
                        <input type="datetime-local" name="posted_on" id="posted_on" class="adm-input"
                               value="{{ old('posted_on', now()->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card-head">
                    <h2 class="adm-card-title">Images</h2>
                    <span class="adm-card-meta">Optional</span>
                </div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="image_1">
                            <i class="ri-image-line"></i> Image 1 <span class="adm-opt">Optional</span>
                        </label>
                        <input type="file" name="image_1" id="image_1" class="adm-input" accept="image/*"
                               onchange="admPreviewImage(this, 'preview_1')">
                        <div id="preview_1" class="adm-image-preview"></div>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="image_2">
                            <i class="ri-image-add-line"></i> Image 2 <span class="adm-opt">Optional</span>
                        </label>
                        <input type="file" name="image_2" id="image_2" class="adm-input" accept="image/*"
                               onchange="admPreviewImage(this, 'preview_2')">
                        <div id="preview_2" class="adm-image-preview"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <div class="adm-actionbar">
        <span class="adm-actionbar-note">Drafts stay hidden from the public site.</span>
        <button type="submit" name="action" value="draft" class="adm-btn">
            <i class="ri-save-line"></i> Save as draft
        </button>
        <button type="submit" name="action" value="publish" class="adm-btn is-success">
            <i class="ri-upload-line"></i> Publish
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
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
