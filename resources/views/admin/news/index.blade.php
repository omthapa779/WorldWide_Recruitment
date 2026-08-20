@extends('essentials.admin_navbar')
@section('title', 'News & Events')
@section('crumb', 'News & Events')

@section('content')
<div class="adm-page-head">
    <div>
        <h1 class="adm-page-title">News &amp; Events</h1>
        <p class="adm-page-sub">{{ $news->total() }} article{{ $news->total() === 1 ? '' : 's' }} in total.</p>
    </div>
    <div class="adm-page-actions">
        <a href="{{ route('admin.news.create') }}" class="adm-btn is-primary"><i class="ri-add-line"></i> Add article</a>
    </div>
</div>

@if(session('success'))
    <div class="adm-alert is-success">
        <span class="adm-alert-title"><i class="ri-check-line"></i> {{ session('success') }}</span>
    </div>
@endif

<div class="adm-card">
    <div class="adm-card-body is-flush">
        @if($news->count())
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th class="is-tight">Image</th>
                        <th>Headline</th>
                        <th class="is-tight">Status</th>
                        <th class="is-tight">Posted</th>
                        <th class="is-tight"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                    <tr>
                        <td class="is-tight">
                            @if($item->image_1 || $item->image_2)
                                <img src="{{ asset('storage/' . ($item->image_1 ?: $item->image_2)) }}" alt="" class="adm-thumb">
                            @else
                                <span class="adm-thumb-empty"><i class="ri-image-line"></i></span>
                            @endif
                        </td>
                        <td>
                            <span class="adm-cell-title">{{ $item->title }}</span>
                            <span class="adm-cell-sub">
                                @if($item->title_ja){{ $item->title_ja }} · @endif
                                {{ \Str::limit(strip_tags($item->content), 90) }}
                            </span>
                        </td>
                        <td class="is-tight">
                            <span class="adm-pill {{ $item->status === 'published' ? 'is-on' : 'is-off' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="is-tight adm-num">
                            {{ $item->posted_on ? \Carbon\Carbon::parse($item->posted_on)->format('Y-m-d') : '—' }}
                        </td>
                        <td class="is-tight">
                            <div class="adm-row-actions">
                                <a href="{{ route('admin.news.edit', $item) }}" class="adm-btn is-sm">
                                    <i class="ri-edit-line"></i> Edit
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this news?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-btn is-sm is-danger">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="adm-empty">
            <i class="ri-newspaper-line"></i>
            <span class="adm-empty-title">No news articles available</span>
            <a href="{{ route('admin.news.create') }}" class="adm-btn is-primary is-sm">Add the first article</a>
        </div>
        @endif
    </div>

    {{ $news->links('admin.partials.pagination') }}
</div>
@endsection
