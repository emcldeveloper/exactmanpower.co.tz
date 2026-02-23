@extends('customer')

@section('title', 'Home')

@section('content')
<style>
.pagination { 
    justify-content: center!important; 
}

.page-item .page-link {
    padding: .2rem .6rem;
    margin-right: 5px;
    border-radius: 5px !important;
    font-size: 10px;
}
.page-item.disabled, .page-item.readonly {
    background: none;
}
</style>

<div class="home-search-section clearfix bg-dark">
    <div class="container home-slogans text-center">
        <h1 class="text-primary font-weight-bold">Almost Everything, Everywhere</h1>
        <h3 class="text-white py-3">A place for business connections</h3>

        <div class="home-search-form mx-auto mt-4 mb-0">
        @include('components.search', ['search_layout'=>'search'])
        </div>
        <div class="category-display card-group px-lg-5">
            @if(isset($display_categories))
                @foreach($display_categories as $row)
                <a href="{{ url('search?category_id='.$row->id) }}" class="card border-bottom-0 p-3">
                    <div class="category-image self-align-center d-flex">
                        <img src="{{ $row->get_icon_url() }}" class="card-img-top" alt="{{ $row->name }}">
                    </div>
                    
                    <div class="card-body px-0 h- pb-0">
                        <h2 class="card-title d-inline-block col-12 h6 font-weight-light p-0">{{ $row->name }}</h2>
                    </div>
                </a>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="section-padding-top clearfix" id="premium_page">
    <div class="container text-center">
        <h3>Premium Ads</h3>
        <p>Find great places to stay, shop or visit the city</p>
        <div class="row justify-content-md-center section-padding-top">
            @if(isset($premium_posts))
                @foreach($premium_posts as $post)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 p-3">
                        {!! $post->featured() !!}
                        <div class="media h-100">
                            <a href="{{ $post->share_link() }}" 
                                style=" height: 100%;background-image:url('{{ $post->get_featured_image() }}');min-width:140px;min-height:120px;"
                                class="d-block media-image align-self-center mr-3" >
                            </a>
                            
                            <div class="media-body text-left">
                                <a class="d-block" href="{{ $post->share_link() }}">
                                    <h5 class="title mt-0 mb-2"><span class="d-inline-block text-truncate col-12 p-0" style="max-width:150px;">{{ $post->post_title }}</span></h5>
                                    <div class="condition text-primary font-weight-bold small mb-1">{{ ($post->condition)? $post->condition->label: null }}</div>
                                    <div class="location small mb-1">{{ ($post->location)? $post->location->name: null }}</div>
                                    <div class="created-at small mb-1">{{ Helper::time_ago($post->created_at) }}</div>
                                    <div class="price text-primary font-weight-bold">Tshs {{ number_format($post->price) }}/=</div>
                                </a>
                                <div class="action">
                                    <div class="btn-group btn-group-sm">
                                        @if(Auth::check())
                                        <a class="btn btn-like {{ ($post->isExtra(PostExtra::TYPE_LIKE)? 'text-primary':'text-light' ) }} p-1" href="{{ url('post/like/'.$post->id) }}"><i class="icon-Like"></i></a>
                                        <!-- <a class="btn text-light p-1" href="#"><i class="icon-favourite"></i></a> -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-12 mt-3">
                    {{ $premium_posts->onEachSide(1)->fragment('premium_page')->links() }}
                </div>
            @endif

        </div>
    </div>  
</div>


<div class="section-padding-top clearfix">
    <div class="container text-center">
        <div class="section-padding-bottom">
            {!! AdvManager::getHTML('after_search') !!}
        </div>

        <h3 id="popular_page">Popular Categories</h3>
        <p>Find great places to stay, shop or visit the city</p>
        <div class="row justify-content-md-center section-padding-top">
        @if(isset($popular_categories))
            @foreach($popular_categories as $row)
            <div class="col-12 col-md-4 col-lg-3 mb-4">
                <a href="{{ url('search?category_id='.$row->id) }}"  class="card h-100 p-3">
                    <div 
                        style="background-image:url('{{ $row->get_image_url() }}');min-width:100%;min-height:120px;"
                        class="d-block media-image align-self-center mb-3" >
                    </div>
                    <div class="media">
                        <div class="media-image-sm align-self-center mr-3 w-100" style="">
                            <img src="{{ $row->get_icon_url() }}" class="w-100" alt="...">
                        </div>
                        
                        <div class="media-body text-left">
                            <h5 class="title m-0"><span class="d-inline-block text-truncate col-12 p-0" style="max-width:150px;">{{ $row->name }}</span></h5>
                            <div class="created-at small">{{ number_format($row->children_stree_count()) }}</div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <div class="col-12 mt-3">
                {{ $popular_categories->onEachSide(1)->fragment('popular_page')->links() }}
            </div>
        @endif
        </div>
    </div>  
</div>


<div class="section-padding-top clearfix">
    <div class="container text-center">
        <h3 class="section-padding-bottom">How It Works</h3>
        <div class="row align-items-center bg-white border p-5">
            <div class="col ">
                <div class="clearfix text-primary">
                    <i class="icon-Group-381 fa-5x"></i>
                </div>
                <h6 class="mt-3">Login/Register</h6>
            </div>
            <div class="col-12 col-md-1 my-3">
                <div class="clearfix">
                    <i class="icon-arrow fa-2x"></i>
                </div>
            </div>
            <div class="col">
                <div class="clearfix text-primary">
                    <i class="icon-Group-378 fa-5x"></i>
                </div>
                <h6 class="mt-3">Create Account</h6>
            </div>
            <div class="col-12 col-md-1 my-3">
                <div class="clearfix">
                    <i class="icon-arrow fa-2x"></i>
                </div>
            </div>
            <div class="col">
                <div class="clearfix text-primary">
                    <i class="icon-Group-384 fa-5x"></i>
                </div>
                <h6 class="mt-3">Choose Packages</h6>
            </div>
            <div class="col-12 col-md-1 my-3">
                <div class="clearfix">
                    <i class="icon-arrow fa-2x"></i>
                </div>
            </div>
            <div class="col">
                <div class="clearfix text-primary">
                    <i class="icon-Group-386 fa-5x"></i>
                </div>
                <h6 class="mt-3">Submit Listings</h6>
            </div>
        </div>
    </div>  
</div>


<div class="section-padding clearfix" id="business_page">
    <div class="container text-center">
        <h3>Premium Business</h3>
        <div class="row justify-content-md-center section-padding-top">
        @if(isset($premium_business))
            @foreach($premium_business as $post)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card d-block h-100 p-3">
                    {!! $post->featured() !!}
                    <a href="{{ $post->share_link() }}" style="background-size:contain; background-image:url('{{ $post->get_featured_image() }}');min-width:100%;min-height:200px;"
                        class="d-block media-image align-self-center mb-3" >
                    </a>

                    <div class="d-flex justify-content-between">
                        <div class="text-left"><a class="font-weight-bold" href="{{ $post->share_link() }}" >{{ $post->post_title }}</a></div>
                        @if(Auth::check())
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-like {{ ($post->isExtra(PostExtra::TYPE_LIKE)? 'text-primary':'text-light' ) }} px-1" href="{{ url('post/like/'.$post->id) }}"><i class="icon-Like"></i></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12 mt-3">
                {{ $premium_business->onEachSide(1)->fragment('business_page')->links() }}
            </div>
        @endif
        </div>
    </div>  
</div>

<div class="section-padding  bg-white">
    <div class="container text-center">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-9">
                <h3 class="text-primary font-weight-bold">Want to grow your business?</h3>
                <p class="m-0 p-0 h4 font-weight-normal">{{ config('app.name') }} is your answer, Post everything and reach thousands buyers every time</p>
            </div>
            <div class="col-12 col-lg-3 mt-5 mt-lg-0 text-center align-self-center">
                <a href="{{ url('package') }}" class="btn btn-primary btn-lg">Explore More Here</a>
            </div>
        </div>  
    </div>  
</div>

<div class="section-padding">
    <div class="container text-center">
        <h3>Blogs</h3>
        <div class="row justify-content-md-center section-padding-top">
        @if(isset($blogs_list))
            @foreach($blogs_list as $row)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <a href="{{ url('blog/'.$row->id.'/'.Str::slug($row->post_title)) }}" 
                        style="background-image:url('{{ $row->get_featured_image() }}');min-width:240px;min-height:200px;"
                        class="d-block media-image align-self-center w-100" >
                    </a>
                    
                    <div class="card-body text-left align-self-center pt-2">
                        <div class="text-light font-weight-bold mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                        <h5 class="title h6 font-weight-bold text-uppercase m-0"><a href="{{ url('blog/'.$row->id) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                        
                        <div class="location mt-1">{!! $row->summary() !!}</div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12 mt-3">
                {{ $blogs_list->onEachSide(1)->links() }}
            </div>
        @endif
        </div>

        <div class="row justify-content-md-center section-padding-top">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <a href="{{ url('search') }}?category_search=movies" class="card card-body h-100 text-white p-2 p-lg-5" style="border-radius:15px;background:#AFB1BA;">
                    <div class="media align-items-center">
                        <img src="{{ asset('img/icon/movies-white.svg') }}" class="mr-3 w-30">
                        <div class="media-body">
                            <h4 class="font-weight-bold mt-0">NEW MOVIES IN CINEMAS</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6 ">
                <a href="{{ url('search') }}?category_search=entertainment" class="card card-body h-100 bg-primary text-white p-2 p-lg-5" style="border-radius:15px;">
                    <img src="{{ asset('img/decoration.svg') }}" class="decoration">
                    <div class="media align-items-center ">
                        <img src="{{ asset('img/icon/events-white.svg') }}" class="mr-3 w-30">
                        <div class="media-body">
                            <h4 class="mt-0 font-weight-bold text-white">ENTERTAINMENT JOIN IN DAR</h4>
                            <h3 class=" mt-0 font-weight-bold text-warning">WAPI PA KUJIRUSHA</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>  
</div>
@endsection
