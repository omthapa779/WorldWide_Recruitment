@extends('essentials.navbar')
@section('title', 'Available Jobs')

@section('content')
<div class="jobs_page w_100 min_100vh primary_font p_s7 p_v7 bg_white flex_cl gap_4vh">
    <x-section-title text="Available Jobs" />

    <div class="jobs_grid w_100 grid col_3 gap_2vw">
        @forelse($jobs as $job)
        <a href="{{ route('jobs.show', $job) }}" 
           class="job_card_page bg_white_light bradius_s hover_scale">
            <div class="job_image_page w_100 h_30vh">
                <img src="{{ asset('storage/' . $job->image_path) }}" 
                     alt="{{ $job->title }}"
                     class="w_100 h_100 obj_cover bradius_top_s">
            </div>
            <div class="job_content p_v4 p_s4 flex_cl gap_1vh">
                <h3 class="color_primary">{{ $job->title }}</h3>
                <div class="flex justify_sb">
                    <h5 class="color_blue">{{ $job->country }}</h5>
                    <h5 class="color_light">{{ $job->positions_left }} Positions</h5>
                </div>
                <h5 class="color_light">{{ \Str::limit($job->description, 100) }}</h5>
            </div>
        </a>
        @empty
        <div class="empty_state text_ac p_v4 col_span_3">
            <h3 class="color_light">No jobs available at the moment</h3>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $jobs->links() }}
    </div>
</div>
@endsection