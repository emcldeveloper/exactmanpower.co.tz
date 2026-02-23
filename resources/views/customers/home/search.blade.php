@extends('customer')

@section('title', 'Search')

@section('main-search')
    @include('components.search', ['search_layout'=>'search'])
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
                <div class="mb-4">
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
                </div>
                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Categories
                        <hr class="mt-2 mb-0">
                    </div>
                    <div class="card-body p-3" style="max-height:460px; overflow:auto;">
                        @foreach($sidebar_filders->related_categoreis as $row)
                        <a href="{{ Helper::query_link('category_id', $row->id) }}"  class="d-flex justify-content-between align-items-center text-dark mb-2">
                            <div class="w-100 d-flex align-items-center">
                                @if($row->get_icon_url())
                                <img class="mr-3" src="{{ $row->get_icon_url() }}" style="width:20px;height:100%;" alt="...">
                                @endif
                                <span class="d-inline-block text-truncate col-12 title p-0 m-0" style="max-width:150px;">{{ $row->name }}</span>
                            </div>
                            <!-- <span class="font-weight-bold">{{ $row->byPosts($post_ids)->count() }}</span> -->
                            <span class="font-weight-bold">{{ $row->children_stree_count() }}</span>
                            
                        </a>
                        @endforeach
                    </div>
                </div>
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
                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Price
                        <hr class="mt-2 mb-0">
                    </div>
                    <form action="{{ url()->full() }}" class="card-body p-3">
                        @if(request('my_ads'))
                        <input type="hidden" name="my_ads" value="{{ request('my_ads') }}">
                        @endif
                        @if(request('verified_sellers'))
                        <input type="hidden" name="verified_sellers" value="{{ request('verified_sellers') }}">
                        @endif
                        @if(request('location'))
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        @endif
                        @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        @endif
                        @if(request('main_search'))
                        <input type="hidden" name="main_search" value="{{ request('main_search') }}">
                        @endif
                        @if(request('sort_by'))
                        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                        @endif

                        <div class="row mb-3">
                            <div class="col-6 pr-2">
                                <input type="number" name="min" value="{{ request('min') }}" class="form-control" placeholder="Min">
                            </div>
                            <div class="col-6 pl-2">
                                <input type="number" name="max" value="{{ request('max') }}" class="form-control" placeholder="Max">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-block" >Apply</button>
                    </form>
                </div>
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

                <div class="card mb-4">
                    <div class="card-header bg-white font-weight-bold border-0 px-3 pt-3 pb-0">
                        Job Categories
                        <hr class="mt-2 mb-0">
                    </div>
                    <div class="card-body p-3" style="max-height:460px; overflow:auto;">
                        @foreach(Helper::job_categories() as $name)
                        <a href="{{ url('job/search?category_id='.$name) }}"  class="d-flex justify-content-between align-items-center text-dark mb-2">
                            <div class="w-100 d-flex align-items-center">
                                
                                <span class="d-inline-block text-truncate col-11 title p-0 m-0">{{ $name }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="card p-4">
                    <div class="d-flex justify-content-between">
                        <ol class="breadcrumb bg-transparent small p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            {!! $categories_tree !!}
                        </ol>
                        <div data-toggle="collapse" data-target="#create_email_alert">Create Email Alert</div>
                    </div>
                    <div class="collapse" id="create_email_alert">
                        <form method="POST" action="{{ url('subscribe') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="redirect" value="{{ url()->full() }}">
                            <div class="row">
                                <div class="form-group col m-0">
                                    <label for="email" class="sr-only">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                    <small class="form-text text-muted"></small>
                                </div>
                                
                                <div class="col-3 pl-0">
                                    <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="selected-filters">
                        @if($category_model)
                        <a href="{{ Helper::query_link(null, null, 'category_id') }}" class="btn-outline-light border small px-2 p-0">{{ $category_model->name }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('main_search'))
                        <a href="{{ Helper::query_link(null, null, 'main_search') }}" class="btn-outline-light border small px-2 p-0">{{ request('main_search') }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('sort_by'))
                        <a href="{{ Helper::query_link(null, null, 'sort_by') }}" class="btn-outline-light border small px-2 p-0">{{ Str::title(request('sort_by')) }} <i class="fa fa-times fa-sm ml-3"></i></a>
                        @endif
                        @if(request('location_id'))
                        <a href="{{ Helper::query_link(null, null, 'location_id') }}" class="btn-outline-light border small px-2 p-0">{{ Helper::locationById(request('location_id')) }} <i class="fa fa-times fa-sm ml-3"></i></a>
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
                            @elseif($category_model)
                            <div class="font-weight-bold">{{ $category_model->name }} in Tanzania</div>
                            @endif
                            
                            <div>{{ $post_list->total() }} results found</div>
                        </div>
                        <div>
                            <form action="" class="input-group input-group-sm m-0">
                                <span class="input-group-prepend">
                                    <button class="btn">
                                    Sort by
                                    </button >
                                </span>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(request('sort_by') == 'newest')
                                            <span>Newest</span>    
                                        @elseif(request('sort_by') == 'oldest')
                                            <span>Oldest</span>
                                        @elseif(request('sort_by') == 'cheapest')
                                            <span>Cheapest</span>
                                        @elseif(request('sort_by') == 'expensive')
                                            <span>Expensive</span>
                                        @else
                                            <span>Newest</span>
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ Helper::query_link('sort_by', 'offer') }}">Special Offer</a>
                                        <a class="dropdown-item" href="{{ Helper::query_link('sort_by', 'newest') }}">Newest</a>
                                        <a class="dropdown-item" href="{{ Helper::query_link('sort_by', 'oldest') }}">Oldest</a>
                                        <a class="dropdown-item" href="{{ Helper::query_link('sort_by', 'cheapest') }}">Cheapest</a>
                                        <a class="dropdown-item" href="{{ Helper::query_link('sort_by', 'expensive') }}">Most expensive</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach($post_list as $post)
                    <div class="card h-100 p-3 mt-3">
                        {!! $post->featured() !!}
                        <div class="d-lg-flex">
                            <a href="{{ $post->share_link() }}" 
                                style="background-image:url('{{ $post->get_featured_image() }}');min-width:240px; {{ ($post->is_business())? 'background-size: contain;':null }}"
                                class="d-block media-image align-self-center mr-lg-5 mb-3 mb-lg-0" >
                            </a>
                            
                            <div class="media-body text-left align-self-center ">
                                @if($post->is_business())
                                <h5 class="title mt-0 mb-2"><a href="{{ $post->share_link() }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                                <div class="location font-weight-bold mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                                <div class="text-dark mb-2">
                                Working hours: 
                                @if($post->today->count())
                                @foreach($post->today as $index => $row)
                                    {!! $row->availability() !!}
                                @endforeach
                                @else
                                    <span>not spacified</span>
                                @endif
                                </div>
                                <div class="location">{!! $post->summary() !!}</div>
                                @else
                                <h5 class="title mt-0  mb-2"><a href="{{ $post->share_link() }}" class="text-secondary">{{ $post->post_title }}</a> </h5>
                                <div class="condition text-primary font-weight-bold mb-2">{!! ($post->condition)? $post->condition->label: null !!}</div>
                                <div class="location mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                                <div class="created-at mb-2">{{ Helper::time_ago($post->created_at) }}</div>
                                <div class="price text-primary font-weight-bold"> <span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <div class="btn-group btn-group-sm">
                                @if($post->call_link())
                                <a class="btn btn-circle btn-primary d-block d-md-none p-1" href="{{ $post->call_link() }}"><i class="icon-call"></i></a>
                                
                                <div class="btn-group btn-group-sm d-none d-md-block ">
                                    <a class="btn btn-circle btn-primary collapsed p-1" href="javascript:;" data-toggle="collapse" data-target="#multi-collapse-phone-{{ $post->id }}" aria-expanded="false"><i class="icon-call"></i></a>
                                    <a class="btn btn-link collapse p-1 mx-2 text-dark" href="javascript:;" id="multi-collapse-phone-{{ $post->id }}">{{ $post->call_link() }}</a>
                                </div>
                                @endif
                                @if($post->whatsapp_link())
                                <a class="btn btn-circle btn-primary p-1 mx-2" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="icon-Group-428"></i></a>
                                @endif
                                <a class="btn btn-circle btn-primary p-1" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"><i class="icon-messages fa-sm"></i></a>
                            </div>
                            <div class="btn-group btn-group-sm">
                                @if(Auth::check())
                                <a class="btn btn-circle btn-outline-dark p-1 mr-2 {{ ($post->isExtra(PostExtra::TYPE_LIKE)? 'text-primary':'text-light' ) }} px-1" href="{{ url('post/like/'.$post->id) }}"><i class="icon-Like"></i></a>
                                @endif
                                <a class="btn btn-circle btn-outline-facebook p-1 mr-2" href="{{ $post->share_facebook() }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-circle btn-outline-twitter p-1 mr-2" href="{{ $post->share_twitter() }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-circle btn-outline-linkedin p-1 mr-2" href="{{ $post->share_linkedin() }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a class="btn btn-circle btn-outline-success p-1" href="{{ $post->share_whatsapp() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>

                            </div>
                        </div>

                        <div class="collapse" id="contact_seller_{{ $post->id }}">
                            <hr class="p-0">
                            <h3>
                                @if($post->is_business())
                                Contact
                                @else
                                Contact Seller
                                @endif
                                <span class="fa fa-times-circle text-danger close" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"></span>
                            </h3>
                            <form method="POST" action="{{ url('post/contact/'.$post->id.'/email') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="redirect" value="{{ url()->full() }}">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name" class="sr-only">Name</label>
                                            <input type="text" name="fullname" class="form-control" placeholder="Enter Your Name">
                                            <small class="form-text text-muted"></small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email address</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                            <small class="form-text text-muted"></small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="phone" class="sr-only">Phone number</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Enter Your phone">
                                            <small class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="col pl-0">
                                        <div class="form-group">
                                            <label for="message" class="sr-only">Message</label>
                                            <textarea name="message" class="form-control " rows="5" placeholder="Your Message"></textarea>
                                            <small class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                    <div class="col text-right">
                                        <a class="btn btn-link" href="#">Read our safety tips</a>
                                    </div>
                                </div>
                            </form>
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
            {{ $post_list->onEachSide(1)->links() }}
        </div>
    </div>
</div>

@endsection
