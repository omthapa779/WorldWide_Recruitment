@extends('essentials.navbar')
@section('title', $job->title)

@section('content')
<div class="job_show_page w_100 min_100vh primary_font bg_white">
    <!-- Hero Section -->
    <div class="job_hero w_100 h_50vh pos_relative">
        <div class="hero_image w_100 h_100 pos_absolute">
            <img src="{{ asset('storage/' . $job->image_path) }}" 
                 alt="{{ $job->title }}"
                 class="w_100 h_100 obj_cover">
        </div>
        <div class="hero_overlay w_100 h_100 pos_absolute top_0 left_0 flex align_e p_s7 p_v7"
             style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent)">
            <div class="hero_content w_100 max_w800 flex_cl gap_2vh justify_c h_100">
                <h5 class="color_white font_w400">{{ $job->country }}</h5>
                <h1 class="color_white">{{ $job->title }}</h1>
                <h4 class="color_white_light opacity_80">
                    {{ $job->positions_left }} Positions Available
                </h4>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="job_content_section w_100 flex justify_c p_s7 p_v5">
        <div class="job_content_grid w_100 gap_4vw">
            <!-- Main Content -->
            <div class="main_content col_span_2 flex_cl gap_4vh">
                <div class="content_text w_100 flex_cl gap_2vh">
                    <h4 class="font_w400">{!! $job->description !!}</h4>
                </div>
            </div>
        </div>
    </div>
    
    @include('sections.contact')
</div>
@endsection