@extends('essentials.admin_navbar')
@section('title', 'Add Job')
@section('page_title', 'Create New Job')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <div class="w_100 flex">
        <x-section-title text="Publish New Job" />
    </div>
     @if($errors->any())
    <div class="alert alert_danger w_100 p_v4 p_s4 bradius_s">
        <h4 class="color_red">
            <i class="ri-error-warning-line"></i> Please fix the following errors:
        </h4>
        <ul class="list_style_disc p_s4 mtop_2vh">
            @foreach($errors->all() as $error)
                <li><h5 class="color_red">{{ $error }}</h5></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="form_card bg_white_light bradius_s p_v4 p_s4 mtop_2vh">
        <form action="{{ route('admin.jobs.store') }}" method="POST" 
              enctype="multipart/form-data" class="w_100 h_fc flex_cl gap_2vw">
            @csrf
            
            <!-- Title -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="title" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-briefcase-line"></i> Job Title</h4>
                </label>
                <input type="text" name="title" id="title" 
                       class="form_input w_100" required 
                       value="{{ old('title') }}"
                       placeholder="Enter job title">
            </div>

            <!-- Positions -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="positions_left" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-team-line"></i> Available Positions</h4>
                </label>
                <input type="number" name="positions_left" id="positions_left" 
                       class="form_input w_100" required min="0"
                       value="{{ old('positions_left') }}"
                       placeholder="Enter number of positions">
            </div>

            <!-- Country -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="country" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-map-pin-line"></i> Country</h4>
                </label>
                <input type="text" name="country" id="country" 
                       class="form_input w_100" required
                       value="{{ old('country') }}"
                       placeholder="Enter job location">
            </div>

            <!-- Description -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="description" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-file-text-line"></i> Job Description</h4>
                </label>
                <textarea name="description" id="summernote" rows="10" 
                          class="form_input w_100" required 
                          placeholder="Enter job description">{{ old('description') }}</textarea>
            </div>

            <!-- Image -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="image" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-image-line"></i> Job Image</h4>
                </label>
                <input type="file" name="image" id="image" 
                       class="form_input w_100" required 
                       accept="image/*">
            </div>

            <!-- Featured -->
           <div class="input_group w_100 flex_cl gap_1vw">
                <label for="is_featured" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-star-line"></i> Featured Job</h4>
                </label>
                <select name="is_featured" id="is_featured" class="form_input w_100" required>
                    <option value="1" {{ old('is_featured') == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_featured') == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="input_group w_100 flex_cl gap_1vw" id="featured_order_group" style="display: {{ old('is_featured', 0) == 1 ? 'block' : 'none' }};">
                <label for="featured_order" class="flex align_c gap_1vw">
                    <h4 class="font_w400"><i class="ri-list-ordered"></i> Featured Order</h4>
                </label>
                <input type="number" name="featured_order" id="featured_order"
                    class="form_input w_100"
                    min="1"
                    value="{{ old('featured_order') }}"
                    placeholder="Order among featured jobs (1 = highest)">
            </div>

            <!-- Submit Button -->
            <x-button type="submit" class="w_100">
                <h3 class="font_w500 color_white">
                    <i class="ri-add-line color_white"></i> Create Job
                </h3>
            </x-button>
        </form>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isFeatured = document.getElementById('is_featured');
    const orderGroup = document.getElementById('featured_order_group');
    if(isFeatured && orderGroup) {
        isFeatured.addEventListener('change', function() {
            orderGroup.style.display = this.value == 1 ? 'block' : 'none';
        });
    }
});
</script>
@endsection