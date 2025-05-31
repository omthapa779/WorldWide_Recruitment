@extends('essentials.admin_navbar')
@section('title', 'Ads Management')
@section('page_title', 'Advertisement Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <!-- Preview -->
    @if($ad)
    <div class="preview_card bg_white_light bradius_s p_v4 p_s4 mtop_2vh">
        <h2 class="color_primary mbottom_2vh">Current Advertisement</h2>
        
        <div class="preview_content w_100 grid col_2 gap_2vw mtop_2vh">
            <div class="preview_image w_100 h_40vh">
                <img src="{{ asset('storage/' . $ad->image_path) }}" 
                     alt="{{ $ad->title }}" 
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            
            <div class="preview_details flex_cl gap_2vw justify_sb">

                <div class="detail_holder w_100 flex_cl gap_1vw">
                    <div class="detail_group">
                        <h5 class="color_light">Title</h5>
                        <h3 class="color_primary">{{ $ad->title }}</h3>
                    </div>
                
                    <div class="detail_group">
                        <h5 class="color_light">Last Updated</h5>
                        <h4 class="color_primary">{{ $ad->updated_at->diffForHumans() }}</h4>
                    </div>
                </div>

                <x-button href="{{ route('admin.ads.edit') }}">
                    <h3 class="font_w500 color_white p_s4">Edit Advertisement</h3>
                </x-button>
            </div>
        </div>
    </div>
    @else
    <div class="empty_state bg_white_light bradius_s p_v4 p_s4 text_ac">
        <h3 class="color_light">No advertisement configured yet</h3>
        <x-button href="{{ route('admin.ads.edit') }}" class="mtop_2vh">
            <h3 class="font_w500 color_white">Set Up Advertisement</h3>
        </x-button>
    </div>
    @endif
</div>
@endsection