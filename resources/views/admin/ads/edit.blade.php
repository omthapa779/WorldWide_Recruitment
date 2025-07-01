@extends('essentials.admin_navbar')
@section('title', 'Edit Advertisement')
@section('page_title', 'Update Advertisement')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <div class="w_100 flex">
        <x-section-title text="Ads Section Form" />
    </div>
    <div class="form_card bg_white_light bradius_s p_v4 p_s4 mtop_2vh">
        <form action="{{ route('admin.ads.update') }}" method="POST" enctype="multipart/form-data" 
              class="w_100 h_fc flex_cl gap_2vw">
            @csrf
            @method('PUT')
            <!-- Title -->
            <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                <label for="title" class="flex align_c gap_1vw">
                   <h3 class="font_w400"><i class="ri-text-snippet"></i> Ad Title</h4>
                </label>
                <input type="text" name="title" id="title" 
                       class="form_input w_100" required 
                       value="{{ $ad->title ?? '' }}"
                       placeholder="Enter advertisement title">
            </div>

            <!-- Image -->
            <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                <label for="image" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-image-line"></i> Ad Image</h4>
                </label>
                <input type="file" name="image" id="image" 
                       class="form_input w_100" 
                       accept="image/*"
                       {{ $ad ? '' : 'required' }}>
            </div>

            @if($ad)
            <div class="current_image w_100 h_20vh">
                <img src="{{ asset('storage/' . $ad->image_path) }}" 
                     alt="Current Ad" 
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            @endif

            <!-- Submit Button -->
            <x-button type="submit" class="w_100">
                <h3 class="font_w500 color_white">
                    <i class="ri-save-line color_white"></i> Update Advertisement
                </h3>
            </x-button>
        </form>
    </div>
</div>
@endsection