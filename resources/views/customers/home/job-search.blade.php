@extends('customer')

@section('title', 'Search')

@section('main-search')
    @include('components.search', ['search_layout'=>'job-search'])
@endsection

@section('content')

<div class="clearfix py-4">
    <div class="container">
        <div class="text-center mb-4">
            {{ AdvManager::getHTML('after_search') }}
        </div>

        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="input-group input-group-sm input-group-search bg-white mb-4">
                    <input class="form-control" type="search" value="{{ request('__search') }}" name="__search" placeholder="Search..."/>
                    <span class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fa fa-search text-light"></i>
                        </button >
                    </span>
                </div>
                <!-- <div class="mb-4">
                    <a href="{{ Helper::query_link('my_ads', 'yes') }}" class="d-block custom-checkbox text-secondary text-decoration-none mb-3">
                        @if(request('my_ads') == 'yes')
                        <i class="far fa-check-circle fa-lg text-primary"></i>
                        @else 
                        <i class="far fa-circle fa-lg"></i>
                        @endif
                        <span class="ml-3">My Ads</span>
                    </a>
                    <a href="{{ Helper::query_link('verified_sellers', 'yes') }}" class="d-block custom-checkbox text-secondary text-decoration-none mb-3">
                        @if(request('verified_sellers') == 'yes')
                        <i class="far fa-check-circle fa-lg text-primary"></i>
                        @else 
                        <i class="far fa-circle fa-lg"></i>
                        @endif
                        <span class="ml-3">Verified sellers only</span>
                    </a>
                </div> -->
                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Categories
                        <hr class="mt-2 mb-0">
                    </div>
                    <div class="card-body p-3" style="max-height:460px; overflow:auto;">
                        @foreach($categories_list as $name)
                        <a href="{{ Helper::query_link('category_id', $name) }}"  class="d-flex justify-content-between align-items-center text-dark mb-2">
                            <div class="w-100 d-flex align-items-center">
                                
                                <span class="d-inline-block text-truncate col-11 title p-0 m-0">{{ $name }}</span>
                            </div>
                            <!-- <span class="font-weight-bold">{{ count($categories_list) }}</span> -->
                        </a>
                        @endforeach
                    </div>
                </div>
                @if(isset($locations_list))
                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Locations
                        <hr class="mt-2 mb-0">
                    </div>
                    <div class="card-body p-3">
                        @foreach($locations_list as $row)
                        <a href="{{ Helper::query_link('location_id', $row->id) }}" class="d-flex justify-content-between text-dark mb-2">
                            <div class="w-100">
                                <span class="title m-0">{{ $row->name }}</span>
                            </div>
                            <span class="font-weight-bold">{{ $row->byPosts($post_ids)->count() }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                @if(isset($category_model) && $category_model && $category_model->conditions->count())
                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Conditions
                        <hr class="mt-2 mb-0">
                    </div>
                    <div class="card-body p-3">
                        @foreach($category_model->conditions as $condition)
                        <div class="d-flex justify-content-between mb-2">
                            <div class="w-100">
                                <span class="title m-0">{{ $condition->label }}</span>
                            </div>
                            <span class="font-weight-bold">{{ $condition->posts($post_ids)->count() }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="col-12 col-lg-7">
                <div class="card p-4">
                    <div class="d-flex justify-content-between">
                        <ol class="breadcrumb bg-transparent small p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            
                        </ol>
                        <!-- <div data-toggle="collapse" data-target="#create_email_alert">Create Email Alert</div> -->
                    </div>
                    <div class="selected-filters">
                        @if(request('category_id'))
                        <a href="{{ Helper::query_link(null, null, 'category_id') }}" class="btn-outline-light border small px-2 p-0">{{ request('category_id') }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('main_search'))
                        <a href="{{ Helper::query_link(null, null, 'main_search') }}" class="btn-outline-light border small px-2 p-0">{{ request('main_search') }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('sort_by'))
                        <a href="{{ Helper::query_link(null, null, 'sort_by') }}" class="btn-outline-light border small px-2 p-0">{{ Str::title(request('sort_by')) }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('location_id'))
                        <a href="{{ Helper::query_link(null, null, 'location_id') }}" class="btn-outline-light border small px-2 p-0">{{ request('location_id') }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('my_ads'))
                        <a href="{{ Helper::query_link(null, null, 'my_ads') }}" class="btn-outline-light border small px-2 p-0">My ads <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('verified_sellers'))
                        <a href="{{ Helper::query_link(null, null, 'verified_sellers') }}" class="btn-outline-light border small px-2 p-0">Verified sellers only <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="d-black">
                            @if(request('main_search')) 
                            <div class="font-weight-bold">{{ request('main_search') }} in Tanzania</div>
                            @elseif(isset($category_model) && $category_model)
                            <div class="font-weight-bold">{{ $category_model->name }} in Tanzania</div>
                            @endif
                            
                            <div>{{ $posts_list->total() }} results found</div>
                        </div>
                    </div>

                    @foreach($posts_list as $post)
                    <div class="card h-100 p-3 mt-3">
                        {!! $post->featured() !!}
                        <div class="d-lg-flex">
                            <a href="{{ url('job/post/'.$post->id.'/'.Str::slug($post->post_title)) }}?image={{ $post->post_featured_image }}&location={{ ( isset($post->post_content_details) && isset($post->post_content_details['location']) )? $post->post_content_details['location']:null }}" 
                                style="background-image:url('{{ $post->post_featured_image }}');background-size:contain;min-width:200px;"
                                class="d-block media-image align-self-center mr-lg-5 mb-3 mb-lg-0" >
                            </a>
                            
                            <div class="media-body text-left align-self-center ">
                                
                                <h5 class="title mt-0  mb-1"><a href="{{ url('job/post/'.$post->id.'/'.Str::slug($post->post_title)) }}?image={{ $post->post_featured_image }}&location={{ ( isset($post->post_content_details) && isset($post->post_content_details['location']) )? $post->post_content_details['location']:null }}" class="text-primary text-capitalize font-weight-bold">{{ strtolower($post->post_title) }}</a> </h5>
                                <div class="text-capitalize font-weight-bold mb-2">{!! ($post->post_sub_title)? strtolower($post->post_sub_title): null !!}</div>
                                <div class="condition font-weight-bold">{!! ($post->condition)? $post->condition: null !!}</div>

                                @if(isset($post->post_content_details) && is_array($post->post_content_details))
                                <div class="price  font-weight-bold text-danger">{{ isset($post->post_content_details['nature'])? $post->post_content_details['nature']: null }}</div>
                                    <div class="price font-weight-bold mb-2">{{ isset($post->post_content_details['location'])? $post->post_content_details['location']: null }}</div>
                                    <div class="price text-primary font-weight-bold">{{ isset($post->post_content_details['deadline'])? $post->post_content_details['deadline']: null }}</div>
                                    
                                @elseif(isset($post->post_content) && is_array($post->post_content))
                                    @foreach($post->post_content as $key => $value)
                                    <div class="price text-primary font-weight-bold">{{ $value }}</div>
                                    @endforeach
                                @endif

                                <div class="btn-group btn-group-sm">
                                    
                                    <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                    <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->share_whatsapp() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div class="card">
                    <div class="card-body text-center p-3">
                    {{ AdvManager::getHTML('side_banner') }}
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body text-center p-3">
                    {{ AdvManager::getHTML('side_banner') }}
                    </div>
                </div>
            </div>
        </div>
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
        </style>
        <div class="mt-3">
            {{ $posts_list->onEachSide(1)->links() }}
        </div>
    </div>
</div>

@endsection
