@extends('website')

@section('title', $post->post_title)
@section('page-title', 'Newsroom')

@section('content')                 
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

table #social-links{
    display: inline-table;
    border: none;
    margin-top: 2em;
}
table #social-links ul li{

    display: inline;
    padding: 0.3em;
}
table #social-links ul li a{

    padding: 7px;
    background-color: #EE7822;
    font-size: 18px;
    color: #FFFFFF;
    border-radius: 30em;
}
</style>
<div class="clearfix py-4">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="clearfix">

                    <!----- Include view from components/alert ----->
                    @component('components.alert')@endcomponent
                    <!----- End include view from components/alert ----->

                    <div class="mx-auto text-center card  border-white mb-3 w-100">
                        <img class="card" style="max-width:100%;" src="{{ $post->image }}" alt="{{ $post->post_title }}">
                    </div>
                    
                    <div class="media-body text-left align-self-center ">
                        {{-- <div class="text-muted h4 mb-3">{{ date('M d, Y', strtotime($post->post_date)) }}</div> --}}


                        <div class="row" style="padding-top: 2em;">
                            <div class="col-md-12 text-muted h4 mb-3">
                                {{ date('M d, Y', strtotime($post->post_date)) }}
                                <label class="d-flex justify-content-end" style="padding-right: 1em; margin-top: -1em;">
                                    <?php $counted = $post->post_view_analysis()->count(); ?>
                                    {{$counted}} &nbsp; <i class="fas fa-eye text-primary"></i>
                                </label>
                            </div>
                        </div>



                        <h2 class="title m-0"><a href="{{ url('get_updated_with/'.$post->post_slug) }}" class="text-secondary">{{ $post->post_title }}</a> </h2>
                        <div class="location my-3">{!! $post->post_content !!}</div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="clearfix p-4">
                        <span class="font-weight-bold mr-3">Share</span>
                        <div class="btn-group btn-group-sm">

                            <table class="table">
                                {{-- implementation is from here  https://www.itsolutionstuff.com/post/how-to-add-social-media-share-buttons-in-laravelexample.html --}}
                                    <tr>
                                        <td style="border: none;">
                                            {!! Share::page(url('get_updated_with/post/'.$post->post_slug))->facebook()->twitter()->whatsapp()->linkedin() !!}
                                        </td>
                                    </tr>
                            </table>

                            {{-- <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->share_whatsapp() }}" target="_blank"><i class="fab fa-whatsapp"></i></a> --}}
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="clearfix p-4">
                        {{-- <div class="fb-comments"
                            data-width="100%"
                            data-href="{{ url()->full() }}"
                            data-numposts="10">
                        </div> --}}
                        <!----- Start form field post_comment ----->
                        {{-- <form method="POST" action="public/comment/{{$post->post_id}}"> --}}
                        <form action="{{ url('admin/posts/posts/comment/'.$post->post_id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mb-1" for="username">
                                            Username
                                        </label>
                                        <input type="text" name="username" placeholder="e.g. deby" class="form-control" required id="_input_username">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-1" for="comment_email" >
                                            Email
                                        </label>
                                        <input type="email" placeholder="e.g john@doe.com" name="email" class="form-control"  required id="_input_email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-1" for="post_comment">
                                    Post Comment
                                </label>
                                
                                <textarea name="post_comment"  class="form-control ckeditor {{ $errors->has('post_comment')? 'is-invalid': null }}" placeholder="Post Comment" rows="4" id="_input_post_comment" required>
                                    {{-- $post->post_content --}}
                                </textarea>
                                <div class="invalid-feedback" id="_help_input_post_content">
                                    {{ $errors->has('post_comment')? $errors->first('post_comment'): null }}
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </form>
                            <!----- End form field post_content ----->
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="clearfix">
                    <form class="clearfix" action="{{ url()->full() }}">
                        <div class="input-group input-group-search ">
                            <input class="form-control" type="search" value="{{ request('__search') }}" name="__search" placeholder="Search..."/>
                            <span class="input-group-append">
                                <button type="submit" class="btn px-3">
                                    <i class="fa fa-search text-muted"></i>
                                </button >
                            </span>
                        </div>
                    </form>

                    {{-- <h4 class="text-uppercase mt-3 mb-3">Categories</h4>
                        <a href="{{ url('get_updated_with') }}" class="btn btn-outline-dark btn-block mb-3">All category</a> --}}
                    @if(isset($categories_list))
                    @foreach($categories_list as $row)
                    <a href="{{ url('get_updated_with/category/'.$row->id) }}" class="btn btn-outline-dark btn-block mb-3">{{ $row->name }} ({{ $row->posts->count() }})</a>
                    @endforeach
                    @endif

                    @if(isset($resent_list) && $resent_list->count())
                        <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Hot News</h6>
                    
                        @foreach($resent_list as $row)
                        <div class="border mb-4">
                            <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" 
                                style="background-image:url('{{ $row->image }}');min-width:240px;"
                                class="d-block media-image align-self-center" >
                            </a>
                            
                            <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                <h5 class="title m-0"><a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                                
                                <div class="location mt-1">{!! $row->post_summary !!}</div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>`
            </div>
        </div>
        <div class="clearfix section-padding">
            <h2 class="text-center">Related News</h2>
            <div class="section-padding-top">
                <div class="row">
                    @if(isset($related_list))
                    @foreach($related_list as $row)
                    <div class="col-12 col-lg-4">
                        <div class="border bg-white h-100">
                            <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" 
                                style="background-image:url('{{ $row->image }}');min-width:240px;"
                                class="d-block media-image align-self-center" >
                            </a>
                            
                            <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                <h5 class="title text-uppercase m-0"><a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                                
                                <div class="location mt-1">{!! $row->post_summary !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
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