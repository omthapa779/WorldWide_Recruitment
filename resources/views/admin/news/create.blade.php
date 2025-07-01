
@extends('essentials.admin_navbar')
@section('title', 'Add News')

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
                    <h4 class="font_w400"><i class="ri-newspaper-line"></i> News Title</h4>
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
             <textarea name="content" id="summernote" class="form_input w_100" required style="max-width: 100%;" row="2" >{{ old('content') }}</textarea>
            </div>

            <!-- Images -->
            <div class="grid col_2 gap_2vw w_100">
                <!-- Image 1 -->
                <div class="input_group w_100 flex_cl gap_1vw">
                    <label for="image_1" class="flex align_c gap_1vw">
                        <h4 class="font_w400"><i class="ri-image-line"></i> Image 1</h4>
                        <h5 class="color_light">(Optional)</h5>
                    </label>
                    <input type="file" name="image_1" id="image_1" 
                           class="form_input w_100" accept="image/*"
                           onchange="previewImage(this, 'preview_1')">
                    <div id="preview_1" class="image_preview h_15vh"></div>
                </div>

                <!-- Image 2 -->
                <div class="input_group w_100 flex_cl gap_1vw">
                    <label for="image_2" class="flex align_c gap_1vw">
                        <h4 class="font_w400"><i class="ri-image-add-line"></i> Image 2</h4>
                        <h5 class="color_light">(Optional)</h5>
                    </label>
                    <input type="file" name="image_2" id="image_2" 
                           class="form_input w_100" accept="image/*"
                           onchange="previewImage(this, 'preview_2')">
                    <div id="preview_2" class="image_preview h_15vh"></div>
                </div>
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
                    <i class="ri-add-line color_white"></i> Create News
                </h3>
            </x-button>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="w_100 h_100 pos_relative">
                    <img src="${e.target.result}" class="w_100 h_100 obj_cover bradius_s">
                </div>`;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
.image_preview {
    background: #f5f5f5;
    border: 0.1vw dashed rgba(0,0,0,0.1);
    border-radius: 0.5vw;
    margin-top: 1vh;
}
</style>
@endsection