@extends('essentials.admin_navbar')
@section('title', 'Hero Section')
@section('crumb', 'Hero Section')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Hero section</h1>
        <p class="adm-page-sub">The banner at the top of the homepage.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.hero.edit') }}" class="adm-btn is-primary"><i class="ri-edit-line"></i> Edit hero</a>
    </div>
</div>

<div class="adm-card">
    @if($hero)
    <div class="adm-card-head">
        <h2 class="adm-card-title">Current configuration</h2>
        <span class="adm-card-meta">Updated {{ $hero->updated_at->diffForHumans() }}</span>
    </div>
    <div class="adm-card-body">
        <div class="adm-grid-2">
            <img src="{{ asset('storage/' . $hero->image_path) }}" alt="" class="adm-preview-img is-wide">
            <dl class="adm-kv">
                <div><dt>Title</dt><dd>{{ $hero->title }}</dd></div>
                <div><dt>Title (JA)</dt><dd>{{ $hero->title_ja ?: '—' }}</dd></div>
                <div><dt>Button</dt><dd>{{ $hero->button_cta }}</dd></div>
                <div><dt>Button (JA)</dt><dd>{{ $hero->button_cta_ja ?: '—' }}</dd></div>
                <div><dt>Last updated</dt><dd>{{ $hero->updated_at->format('Y-m-d H:i') }}</dd></div>
            </dl>
        </div>
    </div>
    @else
    <div class="adm-card-body">
        <div class="adm-empty">
            <i class="ri-image-edit-line"></i>
            <span class="adm-empty-title">No hero section configured yet</span>
            <a href="{{ route('admin.hero.edit') }}" class="adm-btn is-primary is-sm">Set up hero</a>
        </div>
    </div>
    @endif
</div>
@endsection
