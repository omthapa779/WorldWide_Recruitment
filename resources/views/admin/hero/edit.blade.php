@extends('essentials.admin_navbar')
@section('title', 'Edit Hero')
@section('page_title', 'Update Hero Section')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <div class="form_card bg_white_light bradius_s p_v4 p_s4">
        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" 
              class="w_100 h_fc flex_cl gap_2vw">
            @csrf
            @method('PUT')
            <h2 class="color_primary">Hero Section Update</h2>
            <!-- Title -->
            <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                <label for="title" class="flex align_c gap_1vw">
                    <h3 class="font_w400"><i class="ri-text-snippet"></i> Hero Title</h3>
                </label>
                <input type="text" name="title" id="title" 
                       class="form_input w_100" required 
                       value="{{ $hero->title ?? '' }}"
                       placeholder="Enter hero title">
            </div>

            <!-- Button CTA -->
            <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                <label for="button_cta" class="flex align_c gap_1vw">
                    <h3 class="font_w400"><i class="ri-cursor-line"></i> Button Text</h3>
                </label>
                <input type="text" name="button_cta" id="button_cta" 
                       class="form_input w_100" required 
                       value="{{ $hero->button_cta ?? '' }}"
                       placeholder="Enter button text">
            </div>

            <!-- Image -->
            <div class="input_group w_100 flex_cl gap_1vw pos_relative">
                <label for="image" class="flex align_c gap_1vw">
                    <h3 class="font_w400"><i class="ri-image-line"></i> Hero Image</h3>
                </label>
                <input type="file" name="image" id="image" 
                       class="form_input w_100" 
                       accept="image/*"
                       {{ $hero ? '' : 'required' }}>
            </div>

            @if($hero)
            <div class="current_image w_100 h_20vh">
                <img src="{{ asset('storage/' . $hero->image_path) }}" 
                     alt="Current Hero" 
                     class="w_100 h_100 obj_cover bradius_s">
            </div>
            @endif

            <!-- Submit Button -->
             <x-button type="submit" class="w_100">
                <h3 class="font_w500 color_white">
                    <i class="ri-save-line color_white"></i> Update Hero Section
                </h3>
            </x-button>
        </form>
    </div>
</div>
@endsection