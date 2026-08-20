@extends('essentials.admin_navbar')
@section('title', 'Dashboard')
@section('crumb', 'Dashboard')

@section('content')
@php
    $hero = \App\Models\Hero::getActive();
    $ad = \App\Models\Ad::getActive();
    $latestNews = \App\Models\News::latest('posted_on')->take(5)->get();
    $featuredJobs = \App\Models\Job::where('is_featured', true)->orderBy('featured_order')->take(5)->get();
@endphp

<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">Dashboard</h1>
        <p class="adm-page-sub">Content status across the public website.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.jobs.create') }}" class="adm-btn"><i class="ri-add-line"></i> New job</a>
        <a href="{{ route('admin.news.create') }}" class="adm-btn is-primary"><i class="ri-add-line"></i> New article</a>
    </div>
</div>

<!-- Counters -->
<div class="adm-stats">
    <div class="adm-stat">
        <div>
            <div class="adm-stat-label">Total Jobs</div>
            <div class="adm-stat-value adm-num">{{ $statistics['totalJobs'] }}</div>
            <div class="adm-stat-meta">Active listings</div>
        </div>
        <span class="adm-stat-icon"><i class="ri-briefcase-4-line"></i></span>
    </div>

    <div class="adm-stat">
        <div>
            <div class="adm-stat-label">News Posts</div>
            <div class="adm-stat-value adm-num">{{ $statistics['totalNews'] }}</div>
            <div class="adm-stat-meta">Published articles</div>
        </div>
        <span class="adm-stat-icon"><i class="ri-newspaper-line"></i></span>
    </div>

    <div class="adm-stat">
        <div>
            <div class="adm-stat-label">Active Ads</div>
            <div class="adm-stat-value adm-num">{{ $statistics['activeAds'] }}</div>
            <div class="adm-stat-meta">Running campaigns</div>
        </div>
        <span class="adm-stat-icon"><i class="ri-advertisement-line"></i></span>
    </div>

    <div class="adm-stat">
        <div>
            <div class="adm-stat-label">Hero Sections</div>
            <div class="adm-stat-value adm-num">{{ $statistics['heroSections'] }}</div>
            <div class="adm-stat-meta">Active sections</div>
        </div>
        <span class="adm-stat-icon"><i class="ri-layout-masonry-line"></i></span>
    </div>
</div>

<!-- Featured jobs -->
<div class="adm-card">
    <div class="adm-card-head">
        <h2 class="adm-card-title">Featured jobs</h2>
        <a href="{{ route('admin.jobs.index') }}" class="adm-btn is-sm">Manage jobs <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="adm-card-body is-flush">
        @if($featuredJobs->count())
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th class="is-tight">Order</th>
                        <th>Role</th>
                        <th>Destination</th>
                        <th class="is-num">Positions</th>
                        <th class="is-tight"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($featuredJobs as $job)
                    <tr>
                        <td class="is-tight adm-num">{{ $job->featured_order ?? '—' }}</td>
                        <td>
                            <span class="adm-cell-title">{{ $job->title }}</span>
                            @if($job->title_ja)<span class="adm-cell-sub">{{ $job->title_ja }}</span>@endif
                        </td>
                        <td>{{ $job->country }}</td>
                        <td class="is-num">{{ $job->positions_left }}</td>
                        <td class="is-tight">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="adm-btn is-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="adm-empty">
            <i class="ri-briefcase-4-line"></i>
            <span class="adm-empty-title">No featured jobs yet</span>
        </div>
        @endif
    </div>
</div>

<!-- Latest news -->
<div class="adm-card">
    <div class="adm-card-head">
        <h2 class="adm-card-title">Latest news</h2>
        <a href="{{ route('admin.news.index') }}" class="adm-btn is-sm">Manage news <i class="ri-arrow-right-line"></i></a>
    </div>
    <div class="adm-card-body is-flush">
        @if($latestNews->count())
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th class="is-tight">Posted</th>
                        <th>Headline</th>
                        <th class="is-tight">Status</th>
                        <th class="is-tight"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestNews as $news)
                    <tr>
                        <td class="is-tight adm-num">
                            {{ $news->posted_on ? \Carbon\Carbon::parse($news->posted_on)->format('Y-m-d') : '—' }}
                        </td>
                        <td>
                            <span class="adm-cell-title">{{ $news->title }}</span>
                            @if($news->title_ja)<span class="adm-cell-sub">{{ $news->title_ja }}</span>@endif
                        </td>
                        <td class="is-tight">
                            <span class="adm-pill {{ $news->status === 'published' ? 'is-on' : 'is-off' }}">
                                {{ ucfirst($news->status) }}
                            </span>
                        </td>
                        <td class="is-tight">
                            <a href="{{ route('admin.news.edit', $news) }}" class="adm-btn is-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="adm-empty">
            <i class="ri-newspaper-line"></i>
            <span class="adm-empty-title">No news articles yet</span>
        </div>
        @endif
    </div>
</div>

<!-- Hero + Ad, side by side -->
<div class="adm-grid-2" style="margin-top:16px;">
    <div class="adm-card" style="margin-top:0;">
        <div class="adm-card-head">
            <h2 class="adm-card-title">Hero section</h2>
            <a href="{{ route('admin.hero.edit') }}" class="adm-btn is-sm">Edit</a>
        </div>
        <div class="adm-card-body">
            @if($hero)
                <img src="{{ asset('storage/' . $hero->image_path) }}" alt=""
                     class="adm-preview-img is-wide" style="margin-bottom:12px;">
                <dl class="adm-kv">
                    <div><dt>Title</dt><dd>{{ $hero->title }}</dd></div>
                    @if($hero->title_ja)<div><dt>Title (JA)</dt><dd>{{ $hero->title_ja }}</dd></div>@endif
                    <div><dt>Button</dt><dd>{{ $hero->button_cta }}</dd></div>
                    <div><dt>Updated</dt><dd>{{ $hero->updated_at->diffForHumans() }}</dd></div>
                </dl>
            @else
                <div class="adm-empty">
                    <i class="ri-image-edit-line"></i>
                    <span class="adm-empty-title">No hero section configured</span>
                    <a href="{{ route('admin.hero.edit') }}" class="adm-btn is-primary is-sm">Set up hero</a>
                </div>
            @endif
        </div>
    </div>

    <div class="adm-card" style="margin-top:0;">
        <div class="adm-card-head">
            <h2 class="adm-card-title">Advertisement</h2>
            <a href="{{ route('admin.ads.edit') }}" class="adm-btn is-sm">Edit</a>
        </div>
        <div class="adm-card-body">
            @if($ad)
                <img src="{{ asset('storage/' . $ad->image_path) }}" alt=""
                     class="adm-preview-img is-wide" style="margin-bottom:12px;">
                <dl class="adm-kv">
                    <div><dt>Title</dt><dd>{{ $ad->title }}</dd></div>
                    <div><dt>Updated</dt><dd>{{ $ad->updated_at->diffForHumans() }}</dd></div>
                </dl>
            @else
                <div class="adm-empty">
                    <i class="ri-advertisement-line"></i>
                    <span class="adm-empty-title">No advertisement configured</span>
                    <a href="{{ route('admin.ads.edit') }}" class="adm-btn is-primary is-sm">Set up advertisement</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
