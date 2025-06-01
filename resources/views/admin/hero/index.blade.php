@extends('essentials.admin_navbar')
@section('title', 'Hero Management')
@section('page_title', 'Hero Section Overview')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <!-- Action Button -->
    <div class="w_100 flex">
         <x-section-title text="Hero Section Management" />
    </div>

    <!-- Preview -->
    @if($hero)
    <div class="preview_card bg_white_light bradius_s p_v4 p_s4 mtop_2vh">
        
        <div class="preview_content w_100 grid col_2 gap_2vw">
            <div class="preview_image w_100 h_40vh">
                <img src="{{ asset('storage/' . $hero->image_path) }}" 
                     alt="Hero Image" 
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            
            <div class="preview_details flex_cl gap_2vw justify_sb">
                <div class="detail_holder w_100 flex_cl gap_1vw">
                    <div class="detail_group">
                        <h5 class="color_light">Title</h5>
                        <h3 class="color_primary">{{ $hero->title }}</h3>
                    </div>
                    
                    <div class="detail_group">
                        <h5 class="color_light">Button CTA</h5>
                        <h4 class="color_primary">{{ $hero->button_cta }}</h4>
                    </div>
                    
                    <div class="detail_group">
                        <h5 class="color_light">Last Updated</h5>
                        <h4 class="color_primary">{{ $hero->updated_at->diffForHumans() }}</h4>
                    </div>
                </div>
                

                 <x-button href="{{ route('admin.hero.edit') }}" >
                    <h3 class="font_w500 color_white p_s4">Edit Hero</h3>
                </x-button>
            </div>
        </div>
    </div>
    @else
    <div class="empty_state bg_white_light bradius_s p_v4 p_s4 text_ac">
        <h3 class="color_light">No hero section configured yet</h3>
    </div>
    @endif
</div>
@endsection