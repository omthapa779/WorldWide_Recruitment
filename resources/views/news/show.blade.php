@extends('essentials.navbar')
@section('title', $news->title)

@section('content')

<div class="news_show_page w_100 min_100vh primary_font bg_white">
    <!-- Hero Section (show image_1 or image_2 or fallback) -->
    <div class="news_hero w_100 h_50vh pos_relative">
        <div class="hero_image w_100 h_100 pos_absolute">
            @if($news->image_1)
                <img src="{{ asset('storage/' . $news->image_1) }}" alt="{{ $news->title }}" class="w_100 h_100 obj_cover">
            @elseif($news->image_2)
                <img src="{{ asset('storage/' . $news->image_2) }}" alt="{{ $news->title }}" class="w_100 h_100 obj_cover">
            @else
                <div class="w_100 h_100 flex justify_c align_c bg_gray_light bradius_s">
                    <i class="ri-image-line color_light" style="font-size:3rem"></i>
                </div>
            @endif
        </div>
        <div class="hero_overlay w_100 h_100 pos_absolute top_0 left_0 flex align_e p_s7 p_v7"
             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent)">
            <div class="hero_content w_100 h_100 max_w800 flex_cl gap_2vh justify_c">
                <h5 class="color_white font_w400">
                    {{ $news->posted_on ? $news->posted_on->diffForHumans() : '' }}
                </h5>
                <h1 class="color_white">{{ $news->title }}</h1>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="news_content_section w_100 flex_cl justify_c p_s7 p_v7">
        <div class="news_content_grid w_100 max_w1200 flex_cl gap_4vw">
            <!-- Main Content -->
            <div class="main_content flex_cl gap_4vh">
                <div class="content_text w_100 flex_cl gap_2vh">
                    <h4 class=" summernote-content formatted_content font_w500">
                        {!! $news->content !!}
                    <<h4>
                    <div class="news_images flex gap_2vw mtop_2vh">
                        @if($news->image_1)
                            <img src="{{ asset('storage/' . $news->image_1) }}" alt="Image 1" class="w_50 bradius_s shadow_sm obj_cover" style="max-height:300px;">
                        @endif
                        @if($news->image_2)
                            <img src="{{ asset('storage/' . $news->image_2) }}" alt="Image 2" class="w_50 bradius_s shadow_sm obj_cover" style="max-height:300px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sections.contact')
@endsection