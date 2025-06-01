@extends('essentials.admin_navbar')
@section('title', 'News Management')
@section('page_title', 'News Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <!-- Action Buttons -->
    <div class="admin_title grid col_2 justify_sb align_c">
        <x-section-title text="News Management" />
        <x-button href="{{ route('admin.news.create') }}" class="w_40 justify_sfe">
            <h3 class="font_w500 color_white p_s4">Add News</h3>
        </x-button>
    </div>

    <!-- News List -->
    <div class="news_list w_100 grid col_1 gap_2vw mtop_2vh">
        @forelse($news as $item)
        <div class="news_item bg_white_light bradius_s p_v4 p_s2 flex gap_2vw">
            <div class="news_image w_40 h_35vh">
                <img src="{{ asset('storage/' . $item->image_path) }}" 
                     alt="{{ $item->title }}"
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            <div class="news_details w_80 flex_cl justify_sb">
                <div class="flex_cl gap_1vw">
                    <h3 class="color_primary">{{ $item->title }}</h3>
                    <h5 class="color_light">{{ $item->getExcerpt(200) }}</h5>
                    <h5 class="color_blue">Posted {{ $item->time_ago }}</h5>
                </div>
                <div class="flex gap_1vw">
                    <x-button href="{{ route('admin.news.edit', $item) }}">
                        <h4 class="font_w500 color_white p_s4">Edit</h4>
                    </x-button>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class="bg_orange h_100">
                            <h4 class="font_w500 color_white p_s4">Delete</h4>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty_state text_ac p_v4">
            <h4 class="color_light">No news articles yet</h4>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $news->links() }}
    </div>
</div>
@endsection