@extends('essentials.admin_navbar')
@section('title', 'Add News')
@section('page_title', 'Create News Article')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
      <div class="w_100 flex">
        <x-section-title text="Publish New News" />
    </div>
    <div class="form_card bg_white_light bradius_s p_v4 p_s4 mtop_2vh">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" 
              class="w_100 h_fc flex_cl gap_2vw">
            @csrf
            
            <!-- Title -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="title" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-text-line"></i> News Title</h4>
                </label>
                <input type="text" name="title" id="title" 
                       class="form_input w_100" required 
                       value="{{ old('title') }}"
                       placeholder="Enter news title">
            </div>

            <!-- Content -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="content" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-file-text-line"></i> Content</h4>
                </label>
                <textarea name="content" id="content" rows="10" 
                          class="form_input w_100" required 
                          placeholder="Enter news content">{{ old('content') }}</textarea>
            </div>

            <!-- CTA -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="cta" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-cursor-line"></i> Call to Action</h4>
                </label>
                <input type="text" name="cta" id="cta" 
                       class="form_input w_100" required 
                       value="{{ old('cta') }}"
                       placeholder="Enter call to action text">
            </div>

            <!-- Image -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="image" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-image-line"></i> News Image</h4>
                </label>
                <input type="file" name="image" id="image" 
                       class="form_input w_100" required 
                       accept="image/*">
            </div>

            <!-- Posted On -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="posted_on" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-calendar-line"></i> Posted Date</h4>
                </label>
                <input type="datetime-local" name="posted_on" id="posted_on" 
                       class="form_input w_100"
                       value="{{ old('posted_on', now()->format('Y-m-d\TH:i')) }}">
            </div>

            <!-- Submit Button -->
            <x-button type="submit" class="w_100">
                <h3 class="font_w500 color_white">
                    <i class="ri-add-line"></i> Create News
                </h3>
            </x-button>
        </form>
    </div>
</div>
@endsection