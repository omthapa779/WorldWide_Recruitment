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
</div>
@endsection