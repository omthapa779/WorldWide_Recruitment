@extends('essentials.admin_navbar')
@section('title', 'Manage News')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <div class="w_100 flex justify_sb align_c">
        <x-section-title text="All News" />
        <x-button href="{{ route('admin.news.create') }}">
            <h4 class="font_w500 color_white p_s4"><i class="ri-add-line color_white"></i> Add News</h4>
        </x-button>
    </div>
    @if(session('success'))
        <div class="alert alert_success w_100 p_v4 p_s4 bradius_s">
            <h4 class="color_green">{{ session('success') }}</h4>
        </div>
    @endif
    <div class="news_grid w_100 grid col_12 gap_2vw mtop_2vh">
        @forelse($news as $item)
        <div class="news_item bg_white_light bradius_s p_v4 p_s2 flex gap_2vw">
            <div class="news_details w_100 flex_cl justify_sb">
                <div class="flex_cl gap_1vw">
                    <div class="flex gap_2vw align_c">
                        <h3><i class="ri-time-line color_light"></i></h3>
                        <h5 class="color_light">Posted {{ \Carbon\Carbon::parse($item->posted_on)->diffForHumans() }}</h5>
                        <span class="badge {{ $item->status == 'published' ? 'bg_green' : 'bg_gray' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                    <h4 class="color_primary">{{ $item->title }}</h4>
                    <h5 class="color_light">{{ \Str::limit(strip_tags($item->content), 120) }}</h5>
                </div>
                <div class="flex gap_1vw mtop_2vh">
                    <x-button href="{{ route('admin.news.edit', $item) }}">
                        <h4 class="font_w500 color_white p_s4">
                            <i class="ri-edit-line color_white"></i> Edit
                        </h4>
                    </x-button>
                    <form action="{{ route('admin.news.destroy', $item) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this news?');">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class="bg_orange h_100">
                            <h4 class="font_w500 color_white p_s4">
                                <i class="ri-delete-bin-line color_white"></i> Delete
                            </h4>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty_state text_ac p_v4">
            <h4 class="color_light">No news articles available</h4>
        </div>
        @endforelse
    </div>
    <div class="pagination w_100 flex justify_c">
        {{ $news->links() }}
    </div>
</div>
@endsection