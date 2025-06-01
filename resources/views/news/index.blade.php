@extends('essentials.navbar')
@section('title', 'News & Events')

@section('content')
<div class="w_100 min_100vh primary_font p_s7 p_v7 bg_white flex_cl gap_4vh">
    <x-section-title text="News & Events" />

    <!-- News Grid -->
    <div class="news_grid w_100 grid col_3 gap_2vw mtop_2vh">
        @forelse($news as $item)
        <div class="news_card_page h_fc bg_white_light bradius_s hover_scale">
            <div class="news_image w_100 h_30vh">
                <img src="{{ asset('storage/' . $item->image_path) }}" 
                     alt="{{ $item->title }}"
                     class="w_100 h_100 obj_cover bradius_top_s">
            </div>
            <div class="news_content p_v4 p_s2 flex_cl gap_1vh">
                <h5 class="color_blue">{{ $item->time_ago }}</h5>
                <h3 class="color_primary">{{ $item->title }}</h3>
                <h5 class="color_light">{{ $item->getExcerpt(150) }}</h5>
                <div class="button_holder w_100 flex_cl mtop_2vh">
                    <x-button href="{{ route('news.read', $item->id) }}">
                        <h4 class="font_w500 color_white">{{ $item->cta }}</h4>
                    </x-button>
                </div>
            </div>
        </div>
        @empty
        <div class="empty_state text_ac p_v4 col_span_3">
            <h3 class="color_light">No news articles available</h3>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $news->links() }}
    </div>
</div>
@endsection