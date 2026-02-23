@extends('customer')

@section('title', $post->post_title)

@section('main-search')
    @include('components.search', ['search_layout'=>'job-search'])
@endsection

@section('content')

<style>
.lSSlideWrapper {
    border: 1px solid #cccccc;
}

.lSSlideWrapper > ul {
    display: flex;
    align-items: center;
    height: 100%;
}

.lSSlideOuter .lSPager.lSGallery {
    max-height: 90px;
}

.lSSlideOuter .lSPager.lSGallery li {
    border: 1px solid #cccccc;
    max-height: 90px;
    
}

.lSSlideOuter .lSPager.lSGallery li.active, 
.lSSlideOuter .lSPager.lSGallery li:hover {
    border-radius: 0;
    background-color: #ff8000;
}
.lSSlideOuter .lSPager.lSGallery li.active img, 
.lSSlideOuter .lSPager.lSGallery li:hover img {
    opacity: 0.5;
}

</style>
<div class="clearfix py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                @include('customers.shared.single-job')
            </div>
            <div class="col-12 col-lg-4">
                <div class="card" style="margin-top:75px;">
                    <div class="card-body text-center p-4">
                        <div class="clearfix mb-4" >
                            <div class="image-profile rounded-circle mx-auto bg-white border" style="background:url('{{ $post->post_featured_image }}');background-size:contain !important;background-position: center;width:150px;height:150px;margin-top:-100px;"></div>
                        </div>
                        <h6 class="font-weight-bold text-uppercase mb-3">{{ (isset($post->post_profile) && isset($post->post_profile['company']))? $post->post_profile['company']: null }}</h6>
                        
                        <hr>
                        <div class="font-weight-bold my-4">CLICK HERE TO APPLY THIS JOB</div>
                        <a class="btn btn-success btn-block mt-2" target="_blank" href="{{ $post->action_url }}">APPLY HERE</a>

                        <div class="clearfix mt-4 mb-3 ">
                            <span class="font-weight-bold mr-3">Share job</span>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->share_whatsapp() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>

                        <!-- <div class="font-weight-bold text-danger btn btn-link" data-toggle="modal" data-target="#model_report_ads">REPORT THIS JOB</div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix section-padding">
            <h2 class="text-center">Related Jobs</h2>
            <div class="section-padding-top">
                <div class="row">
                    @if(isset($related_list))
                        @for($i = 0; $i < 3; $i++)
                        @php 
                            if(!isset($related_list[$i])) continue;
                            $post = $related_list[$i];
                        @endphp
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="card card-body h-100">
                                <a href="{{ url('job/post/'.$post->id.'/'.Str::slug($post->post_title)) }}?image={{ $post->post_featured_image }}&location={{ ( isset($post->post_content_details) && isset($post->post_content_details['location']) )? $post->post_content_details['location']:null }}" 
                                    style="background-image:url('{{ $post->post_featured_image }}');background-size:contain;min-width:200px;"
                                    class="d-block media-image align-self-center mb-3 w-100" >
                                </a>

                                <div class="media">
                                    <div class="media-body text-left">
                                        <h5 class="title font-weight-bold text-primary m-0">{{ $post->post_title }}</h5>
                                        <div class="title m-0">{{ $post->post_sub_title }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="model_report_ads" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex align-items-center justify-content-between text-primary">
                    <h5 class="modal-title">Report Ads</h5>
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="clearfix" style="font-size:16px;" action="{{ url('post/report/'.$post->id) }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="3"></textarea>
                    </div>
                    <div class="clearfix text-right mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
jQuery(function() {
    if(jQuery.fn.lightSliderBox){
        jQuery('#image-gallery').lightSliderBox({
            gallery:true,
            item:1,
            thumbItem:4,
            slideMargin: 0,
            galleryMargin: 20,
            thumbMargin: 20,
            speed:500,
            auto:true,
            loop:true,
            onSliderLoad: function(el) {
                jQuery('#image-gallery').removeClass('cS-hidden');
                // el.lightSliderBox({
                //     selector: '#image-gallery .lslide'
                // });
            }  
        });
    }
     
});
</script>

@endsection
