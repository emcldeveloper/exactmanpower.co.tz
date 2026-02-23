@extends($parent_layout)

@section('title', 'Blog')

@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('js/plugins/lightslider/css/lightslider.css') }}" />                  
<style>
.lSSlideOuter .lSPager.lSGallery li.active, 
.lSSlideOuter .lSPager.lSGallery li:hover {
    border-radius: 0;
    background-color: #ff8000;
}
.lSSlideOuter .lSPager.lSGallery li.active img, 
.lSSlideOuter .lSPager.lSGallery li:hover img {
    opacity: 0.5;
}

.post_content img {
    max-width: 100%;
    height: auto !important;
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
<div class="clearfix py-4">
    <div class="container">
        <div class="row">
            <div class="col-12 {{ Request::is('admin/*')? 'col-md-12':'col-md-8' }}">
                <div class="card p-4 ">
                    <div class="d-block">
                        <div class="mx-auto text-center border mb-2">
                            <img class="w-100" style="max-width:100%;" src="{{ $post->get_featured_image() }}" alt="{{ $post->post_title }}">
                        </div>
                        
                        <div class="media-body text-left align-self-center ">
                            <div class="text-light font-weight-bold">{{ date('d M, Y', strtotime($post->post_date)) }}</div>
                            <h5 class="title text-uppercase mt-3"><a href="{{ url('blog/'.$post->id) }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                            <div class="post_content">{!! $post->post_content !!}</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="clearfix p-4">
                        <span class="font-weight-bold mr-3">Share</span>
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="clearfix p-4">
                        
                        <div class="fb-comments"
                            data-width="100%"
                            data-href="{{ url()->full() }}"
                            data-numposts="10">
                        </div>
                    </div>
                </div>
            </div>
            @if(!Request::is('admin/*'))
            <div class="col-12 col-md-4">
                <div class="card p-4">
                    <form class="mb-3" action="{{ url('blog') }}">
                        <div class="input-group input-group-search">
                            <input class="form-control" type="search" value="{{ request('__search') }}" name="__search" placeholder="Search..."/>
                            <span class="input-group-append">
                                <button type="submit" class="btn px-3">
                                    <i class="fa fa-search text-light"></i>
                                </button >
                            </span>
                        </div>
                    </form>

                    
                    <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Popular Blog Categories</h6>
                    <a href="{{ url('blog') }}" class="btn btn-outline-dark mb-3">All category</a>
                    @if(isset($categories_list))
                        @foreach($categories_list as $row)
                        <a href="{{ url('blog/category/'.$row->id) }}" class="btn btn-outline-dark mb-3">{{ $row->name }}</a>
                        @endforeach
                    @endif

                    @if(isset($resent_list) && $resent_list->count())
                    <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Popular</h6>
                
                    @foreach($resent_list as $row)
                    <div class="border mb-4">
                        <a href="{{ url('blog/'.$row->id) }}" 
                            style="background-image:url('{{ $row->get_featured_image() }}');min-width:240px;"
                            class="d-block media-image align-self-center" >
                        </a>
                        
                        <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                            <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                            <h5 class="title text-uppercase m-0"><a href="{{ url('blog/'.$row->id) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                            
                            <div class="location mt-1">{!! $row->summary() !!}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
            @endif
        </div>
        @if(!Request::is('admin/*'))
        <div class="clearfix section-padding">
            <h2 class="text-center">Related posts</h2>
            <div class="section-padding-top">
                <div class="row">
                    @if(isset($related_list))
                    @foreach($related_list as $row)
                    <div class="col-12 col-lg-4">
                        <div class="border bg-white h-100">
                            <a href="{{ url('blog/'.$row->id) }}" 
                                style="background-image:url('{{ $row->get_featured_image() }}');min-width:240px;"
                                class="d-block media-image align-self-center" >
                            </a>
                            
                            <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                <h5 class="title text-uppercase m-0"><a href="{{ url('blog/'.$row->id) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                                
                                <div class="location mt-1">{!! $row->summary() !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

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
