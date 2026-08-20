@extends('essentials.admin_navbar')
@section('title', 'Edit Hero')
@section('crumb', 'Hero Section / Edit')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Edit hero section</h1>
        <p class="adm-page-sub">Changes go live on the homepage immediately after saving.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.hero.index') }}" class="adm-btn"><i class="ri-arrow-left-line"></i> Back</a>
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

<form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="adm-form-layout">
        <div>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Text</h2></div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="title">
                            <i class="ri-text-snippet"></i> Hero title <span class="adm-req">*</span>
                        </label>
                        <input type="text" name="title" id="title" class="adm-input" required
                               value="{{ $hero->title ?? '' }}" placeholder="Enter hero title">
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="title_ja">
                            <i class="ri-translate-2"></i> Hero title <span class="adm-opt">日本語</span>
                        </label>
                        <input type="text" name="title_ja" id="title_ja" class="adm-input"
                               value="{{ $hero->title_ja ?? '' }}"
                               placeholder="日本語のタイトル（任意 — 空欄の場合は英語を表示）">
                        <p class="adm-hint">Optional. Shown when a visitor switches the site to Japanese; falls back to the English title if left blank.</p>
                    </div>

                    <div class="adm-grid-2">
                        <div class="adm-field">
                            <label class="adm-label" for="button_cta">
                                <i class="ri-cursor-line"></i> Button text <span class="adm-req">*</span>
                            </label>
                            <input type="text" name="button_cta" id="button_cta" class="adm-input" required
                                   value="{{ $hero->button_cta ?? '' }}" placeholder="Enter button text">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="button_cta_ja">
                                <i class="ri-translate-2"></i> Button text <span class="adm-opt">日本語</span>
                            </label>
                            <input type="text" name="button_cta_ja" id="button_cta_ja" class="adm-input"
                                   value="{{ $hero->button_cta_ja ?? '' }}" placeholder="ボタン文言（任意）">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <aside>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Background image</h2></div>
                <div class="adm-card-body">
                    @if($hero)
                        <img src="{{ asset('storage/' . $hero->image_path) }}" alt=""
                             class="adm-preview-img is-wide" style="margin-bottom:12px;">
                    @endif
                    <div class="adm-field">
                        <label class="adm-label" for="image">
                            <i class="ri-image-line"></i> Hero image
                            @unless($hero)<span class="adm-req">*</span>@endunless
                        </label>
                        <input type="file" name="image" id="image" class="adm-input" accept="image/*"
                               {{ $hero ? '' : 'required' }}
                               onchange="admPreviewImage(this, 'preview_image')">
                        @if($hero)<p class="adm-hint">Leave empty to keep the current image.</p>@endif
                        <div id="preview_image" class="adm-image-preview"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <div class="adm-actionbar">
        <span class="adm-actionbar-note">Fields marked <span class="adm-req">*</span> are required.</span>
        <a href="{{ route('admin.hero.index') }}" class="adm-btn">Cancel</a>
        <button type="submit" class="adm-btn is-primary"><i class="ri-save-line"></i> Update hero section</button>
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
