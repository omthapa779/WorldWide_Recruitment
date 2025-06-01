@extends('essentials.admin_navbar')
@section('title', 'Jobs Management')
@section('page_title', 'Jobs Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <!-- Action Buttons -->
    <div class="admin_title grid col_2 justify_sb align_c">
        <x-section-title text="Jobs Management" />
        <x-button href="{{ route('admin.jobs.create') }}" class="w_40 justify_sfe">
            <h3 class="font_w500 color_white p_s4">
                <i class="ri-add-line color_white"></i> Add Job
            </h3>
        </x-button>
    </div>

    <!-- Jobs Grid -->
    <div class="jobs_grid w_100 grid col_12 gap_2vw mtop_2vh">
        @forelse($jobs as $job)
        <div class="job_item bg_white_light bradius_s p_v4 p_s2 flex gap_2vw">
            <div class="job_image_admin w_40 h_35vh">
                <img src="{{ asset('storage/' . $job->image_path) }}" 
                     alt="{{ $job->title }}"
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            <div class="job_details w_80 flex_cl justify_sb">
                <div class="flex_cl gap_1vw">
                    <div class="flex justify_sb align_c">
                        <h2 class="color_primary">{{ $job->title }}</h2>
                        <div class="status_badge {{ $job->is_featured ? 'bg_green' : 'bg_orange' }} p_v2 p_s4 bradius_s bg_blue">
                            <h5 class="color_white">{{ $job->is_featured ? 'Featured' : 'Not Featured' }}</h5>
                        </div>
                    </div>
                    <div class="flex gap_2vw">
                        <div class="flex align_c gap_1vw">
                            <i class="ri-map-pin-line color_blue"></i>
                            <h5 class="color_blue">{{ $job->country }}</h5>
                        </div>
                        <div class="flex align_c gap_1vw">
                            <i class="ri-team-line color_light"></i>
                            <h5 class="color_light">{{ $job->positions_left }} Positions</h5>
                        </div>
                        <div class="flex align_c gap_1vw">
                            <i class="ri-time-line color_light"></i>
                            <h5 class="color_light">Posted {{ $job->posted_on->diffForHumans() }}</h5>
                        </div>
                    </div>
                    <h5 class="color_light">{{ \Str::limit($job->description, 150) }}</h5>
                </div>
                <div class="flex gap_1vw">
                    <x-button href="{{ route('admin.jobs.edit', $job) }}">
                        <h4 class="font_w500 color_white p_s4">
                            <i class="ri-edit-line color_white"></i> Edit
                        </h4>
                    </x-button>
                    <form action="{{ route('admin.jobs.destroy', $job) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this job?');">
                        @csrf
                        @method('DELETE')
                        <x-button type="submit" class="bg_orange h_100">
                            <h4 class="font_w500 color_white p_s4">
                                <i class="ri-delete-bin-line color_white"></i> Delete
                            </h4>
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty_state text_ac p_v4">
            <h4 class="color_light">No jobs available</h4>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $jobs->links() }}
    </div>
</div>
@endsection