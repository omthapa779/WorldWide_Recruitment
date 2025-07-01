@extends('essentials.admin_navbar')
@section('title', 'News Management')
@section('page_title', 'News Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <!-- Action Buttons -->
    <div class="admin_title grid col_2 justify_sb align_c">
        <x-section-title text="News Management" />
        <x-button href="{{ route('admin.news.create') }}" class="w_50 justify_sfe">
            <h3 class="font_w500 color_white p_s4">
                <i class="ri-add-line color_white"></i> Add News
            </h3>
        </x-button>
    </div>

    <!-- News Grid -->
    <div class="jobs_grid w_100 grid col_12 gap_2vw mtop_2vh">
        @forelse($news as $item)
        <div class="job_item bg_white_light bradius_s p_v4 p_s2 flex gap_2vw">
            <div class="job_image_admin w_40 h_35vh">
                @if($item->image_1)
                    <img src="{{ asset('storage/' . $item->image_1) }}" 
                         alt="{{ $item->title }}"
                         class="w_100 h_100 obj_cover bradius_s">
                @elseif($item->image_2)
                    <img src="{{ asset('storage/' . $item->image_2) }}" 
                         alt="{{ $item->title }}"
                         class="w_100 h_100 obj_cover bradius_s">
                @else
                    <div class="w_100 h_100 flex justify_c align_c bg_gray_light bradius_s">
                        <i class="ri-image-line color_light" style="font-size:3rem"></i>
                    </div>
                @endif
            </div>
            <div class="job_details w_80 flex_cl justify_sb">
                <div class="flex_cl gap_1vw">
                    <div class="flex justify_sb align_c">
                        <h3 class="color_primary">{{ $item->title }}</h3>
                    </div>
                    <div class="flex gap_2vw">
                        <div class="flex align_c gap_1vw">
                            <h3><i class="ri-time-line color_light"></i></h3>
                            <h5 class="color_light">Posted {{ $item->posted_on ? $item->posted_on->diffForHumans() : '-' }}</h5>
                        </div>
                    </div>
                    <h5 class="color_light">{{ \Str::limit(strip_tags($item->content), 150) }}</h5>
                </div>
                <div class="flex gap_1vw">
                    <x-button href="{{ route('admin.news.edit', $item) }}">
                        <h4 class="font_w500 color_white p_s4">
                            <i class="ri-edit-line color_white"></i> Edit
                        </h4>
                    </x-button>
                    <form action="{{ route('admin.news.destroy', $item) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this news?');">
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
            <h4 class="color_light">No news available</h4>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination w_100 flex justify_c">
        {{ $news->links() }}
    </div>
</div>
@endsection