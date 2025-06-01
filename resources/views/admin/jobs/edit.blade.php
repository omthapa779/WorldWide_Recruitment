@extends('essentials.admin_navbar')
@section('title', 'Edit Job')
@section('page_title', 'Edit Job Details')

@section('content')
<div class="w_100 h_fc flex_cl gap_4vh">
    <div class="form_card bg_white_light bradius_s p_v4 p_s4">
        <form action="{{ route('admin.jobs.update', $job) }}" method="POST" 
              enctype="multipart/form-data" class="w_100 h_fc flex_cl gap_2vw">
            @csrf
            @method('PUT')
            
            <!-- Current Preview -->
            <div class="current_preview w_100 flex gap_2vw bg_white bradius_s p_v4 p_s4">
                <div class="preview_image w_40 h_35vh">
                    <img src="{{ asset('storage/' . $job->image_path) }}" 
                         alt="{{ $job->title }}"
                         class="w_100 h_100 obj_cover bradius_s">
                </div>
                <div class="preview_details w_60 flex_cl justify_c gap_1vh">
                    <h3 class="color_primary">Current Details</h3>
                    <h5 class="color_light">Last Updated: {{ $job->updated_at->diffForHumans() }}</h5>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="title">
                    <h4 class="font_w400">Job Title</h4>
                </label>
                <input type="text" name="title" id="title" 
                       class="form_input w_100" required 
                       value="{{ old('title', $job->title) }}">
            </div>

            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="positions_left">
                    <h4 class="font_w400">Available Positions</h4>
                </label>
                <input type="number" name="positions_left" id="positions_left" 
                       class="form_input w_100" required min="0"
                       value="{{ old('positions_left', $job->positions_left) }}">
            </div>

            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="country">
                    <h4 class="font_w400">Country</h4>
                </label>
                <input type="text" name="country" id="country" 
                       class="form_input w_100" required
                       value="{{ old('country', $job->country) }}">
            </div>

            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="description">
                    <h4 class="font_w400">Job Description</h4>
                </label>
                <textarea name="description" id="description" rows="10" 
                          class="form_input w_100" required>{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="input_group w_100 flex_cl gap_1vw">
                <label for="image">
                    <h4 class="font_w400">Update Job Image</h4>
                </label>
                <input type="file" name="image" id="image" 
                       class="form_input w_100" accept="image/*">
                <h5 class="color_light">Leave empty to keep current image</h5>
            </div>

            <div class="input_group w_100 flex gap_1vw align_c">
                <input type="checkbox" name="is_featured" id="is_featured" 
                       class="form_checkbox" {{ $job->is_featured ? 'checked' : '' }}>
                <label for="is_featured">
                    <h4 class="font_w400">Featured Job</h4>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="button_group w_100 flex gap_2vw">
                <x-button type="submit" class="w_100">
                    <h3 class="font_w500 color_white">Update Job</h3>
                </x-button>
                <x-button href="{{ route('admin.jobs.index') }}" 
                         class="w_100 bg_orange">
                    <h3 class="font_w500 color_white">Cancel</h3>
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection