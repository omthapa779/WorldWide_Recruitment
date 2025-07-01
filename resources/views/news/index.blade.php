@extends('essentials.navbar')
@section('title', 'News & Events')

@section('content')
<div class="w_100 min_100vh primary_font p_s7 p_v10 bg_white flex_cl gap_4vh mtop_5vh">
    <x-section-title text="News & Events"/>

    <!-- Masonry News Grid -->
    <div class="news_masonry_grid w_100 mtop_2vh">
        @forelse($news as $item)
        <div class="news_card_masonry bg_white_light bradius_s hover_scale">
            <div class="news_image w_100" style="overflow:hidden; border-radius: 0.7vw 0.7vw 0 0;">
                @if($item->image_1)
                    <img src="{{ asset('storage/' . $item->image_1) }}" alt="{{ $item->title }}" class="w_100 obj_cover" style="max-height:220px;">
                @elseif($item->image_2)
                    <img src="{{ asset('storage/' . $item->image_2) }}" alt="{{ $item->title }}" class="w_100 obj_cover" style="max-height:220px;">
                @else
                    <div class="w_100 h_20vh flex justify_c align_c bg_gray_light bradius_top_s">
                        <i class="ri-image-line color_light" style="font-size:2rem"></i>
                    </div>
                @endif
            </div>
            <div class="news_content p_v4 p_s2 flex_cl gap_1vh">
                <h5 class="color_blue">{{ $item->posted_on ? $item->posted_on->diffForHumans() : '' }}</h5>
                <h3 class="color_primary">{{ $item->title }}</h3>
                <h5 class="color_light">{{ \Str::limit(strip_tags($item->content), 120) }}</h5>
                <div class="button_holder w_100 flex_cl mtop_2vh">
                    <x-button href="{{ route('news.read', $item->id) }}" class="w_100">
                        <h4 class="font_w500 color_white">Read More</h4>
                    </x-button>
                </div>
            </div>
        </div>
        @empty
        <div class="empty_state text_ac p_v4">
            <h3 class="color_light">No news articles available</h3>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $news->links() }}
    </div>
</div>

<style>
.news_masonry_grid {
    column-count: 3;
    column-gap: 1vw;
}
@media (max-width: 999px) {
    .news_masonry_grid { column-count: 2; }
}
@media (max-width: 700px) {
    .news_masonry_grid { column-count: 1; }
}
.news_card_masonry {
    display: inline-masonry;
    width: auto; /* Let the column layout control the width */
    min-width: 150px; /* Optional: set a min width for cards */
    max-width: 100%;
    margin-bottom: 2vw;
    box-sizing: border-box;
    break-inside: avoid;
    -webkit-column-break-inside: avoid;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: box-shadow 0.2s;
}
.news_card_masonry:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    transform: translateY(-4px) scale(1.02);
}
.news_image img {
    width: 100%;
    min-height: 20vh;
    display: block;
    border-radius: 0.7vw 0.7vw 0 0;
    object-fit: cover;
}
</style>
@endsection