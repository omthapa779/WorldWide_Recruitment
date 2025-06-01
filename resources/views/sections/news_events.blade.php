
<section class="news_and_events w_100 h_90vh primary_font p_s7 p_v7 bg_white flex_cl gap_2vw justify_fe">
    <x-section-title text="News & Events" />

    <div class="news_holder w_100 h_100 gap_2vw">
        @php
            $recentNews = \App\Models\News::getLatestNews(4);
            $mainNews = $recentNews->shift();
        @endphp

        @foreach($recentNews as $index => $news)
        <a href="{{ route('news.read', $news->id) }}" 
           class="news_card w_100 h_100 bg_white_light bradius_s flex gap_2vw {{ 'news_' . $index }}">
            <div class="news_normal_image w_100 h_100">
                <img src="{{ asset('storage/' . $news->image_path) }}" 
                     alt="{{ $news->title }} - WorldWide Recruitment Services" 
                     class="bradius_s w_100 h_100 obj_cover">
            </div>
            <div class="news_card_content w_100 h_100 flex_cl justify_c">
                <h5 class="font_w400">{{ $news->time_ago }}</h5>
                <h4>{{ $news->title }}</h4>
                <div class="news_hover_content mtop_2vh">
                    <x-button>
                        <h4 class="font_w500 color_white p_s4 ">{{ $news->cta }}</h4>
                    </x-button>
                </div>
            </div>
        </a>
        @endforeach

        @if($mainNews)
        <a href="{{ route('news.read', $mainNews->id) }}" class="main_news w_100 h_100">
            <div class="main_news_image w_100 h_100 flex justify_fe">
                <img src="{{ asset('storage/' . $mainNews->image_path) }}" 
                     alt="{{ $mainNews->title }} - WorldWide Recruitment Services" 
                     class="bradius_s w_90 h_100 obj_cover">
            </div>
            <div class="news_content_main w_100 h_100 flex align_c">
                <div class="news_box w_fc h_fc bg_light flex_cl">
                    <h5 class="font_w400">{{ $mainNews->time_ago }}</h5>
                    <h2>{{ $mainNews->title }}</h2>
                    <h5 class="color_light font_w500">{{ $mainNews->getExcerpt() }}</h5>
                    <div class="button_holder w_100 flex_cl mtop_2vh">
                        <x-button>
                            <h3 class="font_w500 color_white">{{ $mainNews->cta }}</h3>
                        </x-button>
                    </div>
                </div>
            </div>
        </a>
        @endif
    </div>
</section>