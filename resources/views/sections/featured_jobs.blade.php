<section class="featured_jobs w_100 h_80vh bg_white primary_font flex_cl p_s7 p_v7 gap_2vw justify_c">
    <div class="featured_title flex justify_sb">
        <x-section-title text="Featured Jobs" />
        <div class="button_holder w_20 flex_cl">
            <x-button href="{{ route('jobs.index') }}" variant="secondary" class="opacity_80">
                <h3 class="color_white">Explore More</h3>
            </x-button>
        </div>
    </div>

    <div class="jobs_holder w_100 h_100 grid col_left_3 gap_2vw">
        @php
            $featuredJobs = \App\Models\Job::getFeaturedJobs(5);
            $mainJob = $featuredJobs->shift();
        @endphp

        @if($mainJob)
        <a href="{{ route('jobs.show', $mainJob->id) }}" 
           class="main_featured_job job_card w_100 h_100 pos_relative">
            <img src="{{ asset('storage/' . $mainJob->image_path) }}" 
                 class="job_image w_100 h_100 obj_cover"
                 alt="{{ $mainJob->title }} - WorldWide Recruitment Services">
            
            <div class="overlay w_100 h_100 bg_dark opacity_80 pos_absolute"></div>

            <div class="job_card_content w_100 h_100 flex_cl justify_fe p_s4 pos_absolute">
                <h2 class="color_white">{{ $mainJob->title }}</h2>
                <h4 class="color_white_light opacity_80 font_w500">
                    {{ $mainJob->positions_left }} Positions Left
                </h4>
            </div>
        </a>
        @endif

        @foreach(collect($featuredJobs)->chunk(2) as $jobPair)
        <div class="job_two_holder grid row_2 gap_2vw">
            @foreach($jobPair as $job)
            <a href="{{ route('jobs.show', $job->id) }}" 
               class="job_card pos_relative w_100 h_100 bg_blue">
                <img src="{{ asset('storage/' . $job->image_path) }}" 
                     class="job_image w_100 h_100 obj_cover"
                     alt="{{ $job->title }} - WorldWide Recruitment Services">
            
                <div class="overlay w_100 h_100 bg_dark opacity_80 pos_absolute"></div>

                <div class="job_card_content w_100 h_100 flex_cl justify_fe p_s4 pos_absolute">
                    <h2 class="color_white">{{ $job->title }}</h2>
                    <h4 class="color_white_light opacity_80 font_w500">
                        {{ $job->positions_left }} Positions Left
                    </h4>
                </div>
            </a>
            @endforeach
        </div>
        @endforeach
    </div>
</section>