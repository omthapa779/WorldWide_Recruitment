@extends('essentials.navbar')
@section('title', $news->title)

@section('content')
<div class="news_show_page w_100 min_100vh primary_font bg_white">
    <!-- Hero Section -->
    <div class="news_hero w_100 h_50vh pos_relative">
        <div class="hero_image w_100 h_100 pos_absolute">
            <img src="{{ asset('storage/' . $news->image_path) }}" 
                 alt="{{ $news->title }}"
                 class="w_100 h_100 obj_cover">
        </div>
        <div class="hero_overlay w_100 h_100 pos_absolute top_0 left_0 flex align_e p_s7 p_v7"
             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent)">
            <div class="hero_content w_100 h_100 max_w800 flex_cl gap_2vh justify_c">
                <h5 class="color_white font_w400">{{ $news->time_ago }}</h5>
                <h1 class="color_white">{{ $news->title }}</h1>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="news_content_section w_100 flex justify_c p_s7 p_v7">
        <div class="news_content_grid w_100 max_w1200 grid col_3 gap_4vw">
            <!-- Main Content -->
            <div class="main_content col_span_2 flex_cl gap_4vh">
                <div class="content_text w_100 flex_cl gap_2vh">
                    <p class="formatted_content">
                        {!! nl2br(e($news->content)) !!}
                    </p>
                </div>
            </div>

            <!-- Related News Sidebar -->
            <div class="related_news flex_cl gap_2vh">
                <div class="sidebar_header mbottom_2vh">
                       <x-section-title text="Related Articles" />
                </div>
                
                @foreach($relatedNews as $related)
                <a href="{{ route('news.read', $related->id) }}" 
                   class="related_card bg_white_light bradius_s hover_scale">
                    <div class="related_image w_100 h_20vh">
                        <img src="{{ asset('storage/' . $related->image_path) }}" 
                             alt="{{ $related->title }}"
                             class="w_100 h_100 obj_cover bradius_top_s">
                    </div>
                    <div class="related_content p_v4 p_s4 flex_cl gap_1vh">
                        <h5 class="color_blue font_w400">{{ $related->time_ago }}</h5>
                        <h4 class="color_primary">{{ $related->title }}</h4>
                        <h5 class="color_light">{{ \Str::limit($related->content, 100) }}</h5>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection