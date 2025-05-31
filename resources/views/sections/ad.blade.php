<section class="ads w_100 h_fc bg_white p_v7">
    @if($ad = \App\Models\Ad::getActive())
        <img src="{{ asset('storage/' . $ad->image_path) }}" 
             alt="{{ $ad->title }} - WorldWide Recruitment Services" 
             class="w_100 h_100 obj_cover asp_3_1">
    @else
        <img src="{{ asset('./resources/images/test_ad.png') }}" 
             alt="Advertisement - WorldWide Recruitment Services" 
             class="w_100 h_100 obj_cover asp_3_1">
    @endif
</section>