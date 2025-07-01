<section class="news_and_events w_100 h_fc primary_font p_s7 p_v7 bg_white flex_cl gap_4vh">
    <x-section-title text="News & Events" />

    @php
        $allNews = \App\Models\News::where('status', 'published')->latest()->take(5)->get();
        $tableNews = $allNews->take(5);
    @endphp

    <!-- Table-style Recent News -->
    <div class="recent_news w_100 mtop_2vh">
        <div class="news_table w_100 flex_cl">
            @foreach($tableNews as $news)
            <a href="{{ route('news.read', $news->id) }}" 
               class="news_row w_100 p_v4 p_s4 hover_bg">
                <div class="news_content flex_cl gap_1vh">
                    <div class="flex justify_sb align_c">
                        <h3 class="color_primary">{{ $news->title }}</h3>
                        <h5 class="color_light text_ar">{{ $news->time_ago }}</h5>
                    </div>
                    <h5 class="color_dark">{{ $news->getExcerpt(150) }}</h5>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>