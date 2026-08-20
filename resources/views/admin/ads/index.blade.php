@extends('essentials.admin_navbar')
@section('title', 'Advertisement')
@section('crumb', 'Advertisement')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Advertisement</h1>
        <p class="adm-page-sub">The banner shown between sections on the homepage.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.ads.edit') }}" class="adm-btn is-primary"><i class="ri-edit-line"></i> Edit advertisement</a>
    </div>
</div>

<div class="adm-card">
    @if($ad)
    <div class="adm-card-head">
        <h2 class="adm-card-title">Current configuration</h2>
        <span class="adm-card-meta">Updated {{ $ad->updated_at->diffForHumans() }}</span>
    </div>
    <div class="adm-card-body">
        <div class="adm-grid-2">
            <img src="{{ asset('storage/' . $ad->image_path) }}" alt="{{ $ad->title }}" class="adm-preview-img is-wide">
            <dl class="adm-kv">
                <div><dt>Title</dt><dd>{{ $ad->title }}</dd></div>
                <div><dt>Last updated</dt><dd>{{ $ad->updated_at->format('Y-m-d H:i') }}</dd></div>
            </dl>
        </div>
    </div>
    @else
    <div class="adm-card-body">
        <div class="adm-empty">
            <i class="ri-advertisement-line"></i>
            <span class="adm-empty-title">No advertisement configured yet</span>
            <a href="{{ route('admin.ads.edit') }}" class="adm-btn is-primary is-sm">Set up advertisement</a>
        </div>
    </div>
    @endif
</div>
@endsection
