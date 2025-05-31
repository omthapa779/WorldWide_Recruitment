@extends('essentials.admin_navbar')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_2vw primary_font mtop_2vh">
    <!-- Stats Cards -->
    <div class="stats_holder_dashboard w_100 grid col_2 gap_1vw">
        <!-- Jobs Card -->
        <div class="stat_card bg_white_light bradius_s p_v4 p_s4 hover_scale">
            <div class="flex justify_sb align_c">
                <div class="flex_cl gap_1vh">
                    <h4 class="color_primary font_w500">Total Jobs</h4>
                    <h2 class="color_primary">{{ $statistics['totalJobs'] }}</h2>
                    <h5 class="color_light">Active Listings</h5>
                </div>
                <div class="stat_bubble bg_blue_light">
                    <h2 class="font_w400"><i class="ri-suitcase-line color_blue"></i></h2>
                </div>
            </div>
        </div>

        <!-- News Card -->
        <div class="stat_card bg_white_light bradius_s p_v4 p_s4 hover_scale">
            <div class="flex justify_sb align_c">
                <div class="flex_cl gap_1vh">
                    <h4 class="color_primary font_w500">News Posts</h4>
                    <h2 class="color_primary">{{ $statistics['totalNews'] }}</h2>
                    <h5 class="color_light">Published Articles</h5>
                </div>
                <div class="stat_bubble bg_blue_light">
                    <h2 class="font_w400"><i class="ri-newspaper-line color_blue"></i></h2>
                </div>
            </div>
        </div>

        <!-- Ads Card -->
        <div class="stat_card bg_white_light bradius_s p_v4 p_s4 hover_scale">
            <div class="flex justify_sb align_c">
                <div class="flex_cl gap_1vh">
                    <h4 class="color_primary font_w500">Active Ads</h4>
                    <h2 class="color_primary">{{ $statistics['activeAds'] }}</h2>
                    <h5 class="color_light">Running Campaigns</h5>
                </div>
                <div class="stat_bubble bg_blue_light">
                    <h2 class="font_w400"><i class="ri-advertisement-line color_blue"></i></h2>
                </div>
            </div>
        </div>

        <!-- Hero Card -->
        <div class="stat_card bg_white_light bradius_s p_v4 p_s4 hover_scale">
            <div class="flex justify_sb align_c">
                <div class="flex_cl gap_1vh">
                    <h4 class="color_primary font_w500">Hero Sections</h4>
                    <h2 class="color_primary">{{ $statistics['heroSections'] }}</h2>
                    <h5 class="color_light">Active Sections</h5>
                </div>
                <div class="stat_bubble bg_blue_light">
                    <h2 class="font_w400"><i class="ri-layout-masonry-line color_blue"></i></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section Management -->
    <div class="section_card h_fc bg_white_light bradius_s p_v4 p_s4">
        <div class="flex justify_sb align_c mbottom_2vh">
            <h2 class="color_primary">Hero Section</h2>
            <x-button href="{{ route('admin.hero.edit') }}" >
                <h3 class="font_w500 color_white p_s4">Edit Hero</h3>
            </x-button>
        </div>

        @if($hero = \App\Models\Hero::getActive())
        <div class="hero_preview w_100 grid col_2 gap_2vw mtop_2vh">
            <!-- Image Preview -->
            <div class="preview_image w_100 h_30vh">
                <img src="{{ asset('storage/' . $hero->image_path) }}" 
                     alt="Hero Image" 
                     class="w_100 h_100 obj_cover bradius_s">
            </div>

            <!-- Content Preview -->
            <div class="preview_content flex_cl justify_c gap_1vw">
                <div class="preview_item">
                    <h5 class="color_light">Title</h5>
                    <h3 class="color_primary">{{ $hero->title }}</h3>
                </div>

                <div class="preview_item">
                    <h5 class="color_light">Button CTA</h5>
                    <h4 class="color_primary">{{ $hero->button_cta }}</h4>
                </div>

                <div class="preview_item">
                    <h5 class="color_light">Last Updated</h5>
                    <h4 class="color_blue">{{ $hero->updated_at->diffForHumans() }}</h4>
                </div>
            </div>
        </div>
        @else
        <div class="empty_state text_ac p_v4">
            <h4 class="color_light">No hero section configured yet</h4>
            <x-button href="{{ route('admin.hero.edit') }}" class="mtop_2vh">
                <h3 class="font_w500 color_white">Set Up Hero</h3>
            </x-button>
        </div>
        @endif
    </div>
</div>
@endsection