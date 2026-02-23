@extends('website')

@section('title', 'Newsroom')
@section('page-title', 'Stay Connected With Us')

@section('content')

<style>
.pagination { 
    justify-content: center!important; 
}

.page-item .page-link {
    padding: .2rem .6rem;
    margin-right: 5px;
    border-radius: 5px !important;
}
.page-item.disabled, .page-item.readonly {
    background: none;
}

.social-btn-sp #social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    .social-btn-sp #social-links ul li {
        display: inline-block;
    }          
    .social-btn-sp #social-links ul li a {
        padding: 15px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        border: none;

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

<div class="clearfix">
    <div class="container py-5">
        <div class="clearfix">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="clearfix">
                        <!-- <h3 class="mb-4">{{ 'Blog' }}</h3> -->
                        <!-- <form class="mb-4" action="{{ url()->full() }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="__search" value="{{ request('__search') }}" class="form-control" placeholder="Quick search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form> -->
                        <div class="row">
                        @if(isset($blog_list) && $blog_list->count())
                            @foreach($blog_list as $row)
                            {{-- $row --}}
                            <div class="col-12 col-lg-12  mb-4">
                                <div class="h-100">
                                    
                                    <div class="media-body text-left align-self-center pb-4 pt-3">
                                        <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" 
                                            style="background-image:url('{{ $row->image }}');min-width:240px;min-height:340px;"
                                            class="d-block media-image card align-self-center" >
                                        </a>

                                        <div class="row" style="padding-top: 2em;">
                                            <div class="col-md-12 text-muted h4 mb-3">
                                                {{ date('M d, Y', strtotime($row->post_date)) }}
                                                <label class="d-flex justify-content-end" style="padding-right: 1em; margin-top: -1em;">
                                                    <?php $counted = $row->post_view_analysis()->count(); ?>
                                                    {{$counted}} &nbsp; <i class="fas fa-eye text-primary"></i>
                                                </label>
                                            </div>
                                        </div>

                                        <h2 class="title m-0">
                                            <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="text-secondary">{{ $row->post_title }}</a> 
                                        </h2>
                                        
                                        <div class="location my-3">{!! $row->post_summary !!}</div>
                                        <div class="d-flex align-items-center justify-content-between pt-2">
                                            <div class="">
                                                <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="btn btn-primary btn-lg rounded-pill box-shadow py-3">Read More</a>
                                            </div>
                                                                                         
                                                <div class="social-links outline text-center text-md-left my-0 text-white">
                                                    <table class="table">
                                                        {{-- the implementation is from https://www.itsolutionstuff.com/post/how-to-add-social-media-share-buttons-in-laravelexample.html --}}
                                                            <tr>
                                                                <td style="border: none;">
                                                                    {!! Share::page(url('get_updated_with/post/'.$row->post_slug))->facebook()->twitter()->whatsapp()->linkedin() !!}
                                                                </td>
                                                            </tr>
                                                    </table>

                                                    {{-- <a class="btn btn-primary btn-circle btn-sm mr-1" href="https://facebook.com/exactmanpower"
                                                        target="_blank">
                                                        <i class="fab fa-facebook-f fa-1x"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-circle btn-sm mr-1" href="https://twitter.com/exactmanpower"
                                                        target="_blank">
                                                        <i class="fab fa-twitter fa-1x"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-circle btn-sm mr-1" href="https://www.instagram.com/exactmanpower"
                                                        target="_blank">
                                                        <i class="fab fa-instagram fa-1x"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-circle btn-sm mr-1" href="https://www.linkedin.com/in/exactmanpower"
                                                        target="_blank">
                                                        <i class="fab fa-linkedin fa-1x"></i>
                                                    </a> --}}
                                                </div>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-12">
                               {{$blog_list->onEachSide(1)->links('pagination::bootstrap-4')}} 
                                {{-- $blog_list->onEachSide(1)->links() --}}
                            </div>
                        @else
                            <div class="col">No newsroom post</div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
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
                        {{-- <h4 class="text-uppercase mt-3 mb-3">Categories</h4> --}}
                         {{-- <a href="{{ url('get_updated_with') }}" class="btn btn-outline-dark btn-block mb-3">All News</a> --}}
                        @if(isset($categories_list))
                        @foreach($categories_list as $row)
                        <a href="{{ url('get_updated_with/category/'.$row->post_slug) }}" class="btn btn-outline-dark btn-block mb-3">{{ $row->name }} ({{ $row->posts->count() }})</a>
                        @endforeach
                        @endif

                        @if(isset($resent_list) && $resent_list->count())
                            <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Hot News</h6>
                        <?php 
                            $newroom = Post::where('post_type_id','newsroom')->get();
                            $duplicate = DB::table('post_views_analysis')
                         ?>

                            @foreach($resent_list as $row)
                            <div class="border mb-4">
                                <a href="{{ url('get_updated_with/'.$row->post_slug) }}" 
                                    style="background-image:url('{{ $row->image }}');min-width:240px;"
                                    class="d-block media-image align-self-center" >
                                </a>
                                
                                <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                    <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                    <h5 class="title m-0"><a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="text-primary">{{ $row->post_title }}</a> </h5>

                                    <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="btn btn-primary btn-lg rounded-pill box-shadow py-3">Read More</a>
                                    
                                    <div class="location mt-1">{!! \Illuminate\Support\Str::limit($row->post_content, 800) !!}</div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-center" style="padding: 1em">
                                    <a href="{{ url('get_updated_with/post/'.$row->post_slug) }}" class="btn btn-primary btn-lg rounded-pill box-shadow py-3">Read More</a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection