@extends('essentials.admin_navbar')
@section('title', 'Edit Advertisement')
@section('crumb', 'Advertisement / Edit')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Edit advertisement</h1>
        <p class="adm-page-sub">Changes go live on the homepage immediately after saving.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.ads.index') }}" class="adm-btn"><i class="ri-arrow-left-line"></i> Back</a>
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

<form action="{{ route('admin.ads.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="adm-form-layout">
        <div>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Details</h2></div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label" for="title">
                            <i class="ri-text-snippet"></i> Ad title <span class="adm-req">*</span>
                        </label>
                        <input type="text" name="title" id="title" class="adm-input" required
                               value="{{ $ad->title ?? '' }}" placeholder="Enter advertisement title">
                        <p class="adm-hint">Used as the image's alternative text on the public site.</p>
                    </div>
                </div>
            </div>
        </div>

        <aside>
            <div class="adm-card" style="margin-top:0;">
                <div class="adm-card-head"><h2 class="adm-card-title">Banner image</h2></div>
                <div class="adm-card-body">
                    @if($ad)
                        <img src="{{ asset('storage/' . $ad->image_path) }}" alt=""
                             class="adm-preview-img is-wide" style="margin-bottom:12px;">
                    @endif
                    <div class="adm-field">
                        <label class="adm-label" for="image">
                            <i class="ri-image-line"></i> Ad image
                            @unless($ad)<span class="adm-req">*</span>@endunless
                        </label>
                        <input type="file" name="image" id="image" class="adm-input" accept="image/*"
                               {{ $ad ? '' : 'required' }}
                               onchange="admPreviewImage(this, 'preview_image')">
                        @if($ad)<p class="adm-hint">Leave empty to keep the current image.</p>@endif
                        <div id="preview_image" class="adm-image-preview"></div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <div class="adm-actionbar">
        <span class="adm-actionbar-note">Fields marked <span class="adm-req">*</span> are required.</span>
        <a href="{{ route('admin.ads.index') }}" class="adm-btn">Cancel</a>
        <button type="submit" class="adm-btn is-primary"><i class="ri-save-line"></i> Update advertisement</button>
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
