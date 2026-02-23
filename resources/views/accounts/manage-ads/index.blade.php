@extends('account')

@section('title', 'Posts')

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
</style>


<!-- <h4 class="pb-2 pt-3">Manage Ads</h4> -->
<div class="card bg-transparent border-0 mb-4 mt-4"> 
    <div class="btn-group">
        <a href="{{ url('account/manage-ads/'.request('status')) }}" class="btn {{ Request::is('account/manage-ads/*')? null: 'btn-white bg-white' }} px-4"><span class="h5">Manage Ads/Directory</span></a>
        <a href="{{ url('account/manage-banners/'.request('status')) }}" class="btn {{ Request::is('account/manage-banners/*')? null: 'btn-white bg-white' }} px-4"><span class="h5">Manage Banners</span></a>
    </div>
</div>

<div class="card border-0 mb-4"> 
    @if(Request::is('account/manage-ads/*'))
    <div class="btn-group">
        <a href="{{ url('account/manage-ads/draft') }}" class="btn {{ Request::is('account/manage-ads/draft')? 'btn-light': null }} px-4">Draft</a>
        <a href="{{ url('account/manage-ads/waiting-approval') }}" class="btn {{ Request::is('account/manage-ads/waiting-approval')? 'btn-light': null }} px-4">Waiting Approval</a>
        <a href="{{ url('account/manage-ads/online') }}" class="btn {{ Request::is('account/manage-ads/online')? 'btn-light': null }} px-4">Online</a>
        <a href="{{ url('account/manage-ads/expire-soon') }}" class="btn {{ Request::is('account/manage-ads/expire-soon')? 'btn-light': null }} px-4">Expire Soon</a>
        <a href="{{ url('account/manage-ads/expired') }}" class="btn {{ Request::is('account/manage-ads/expired')? 'btn-light': null }} px-4">Expired</a>
        <a href="{{ url('account/manage-ads/offline') }}" class="btn {{ Request::is('account/manage-ads/offline')? 'btn-light': null }} px-4">Offline</a>
        <a href="{{ url('account/manage-ads/rejected') }}" class="btn {{ Request::is('account/manage-ads/rejected')? 'btn-light': null }} px-4">Rejected</a>
    </div>
    @elseif(Request::is('account/manage-banners/*'))
    <div class="btn-group">
        <a href="{{ url('account/manage-banners/draft') }}" class="btn {{ Request::is('account/manage-banners/draft')? 'btn-light': null }} px-4">Draft</a>
        <a href="{{ url('account/manage-banners/waiting-approval') }}" class="btn {{ Request::is('account/manage-banners/waiting-approval')? 'btn-light': null }} px-4">Waiting Approval</a>
        <a href="{{ url('account/manage-banners/online') }}" class="btn {{ Request::is('account/manage-banners/online')? 'btn-light': null }} px-4">Online</a>
        <a href="{{ url('account/manage-banners/expire-soon') }}" class="btn {{ Request::is('account/manage-banners/expire-soon')? 'btn-light': null }} px-4">Expire Soon</a>
        <a href="{{ url('account/manage-banners/expired') }}" class="btn {{ Request::is('account/manage-banners/expired')? 'btn-light': null }} px-4">Expired</a>
        <a href="{{ url('account/manage-banners/offline') }}" class="btn {{ Request::is('account/manage-banners/offline')? 'btn-light': null }} px-4">Offline</a>
        <a href="{{ url('account/manage-banners/rejected') }}" class="btn {{ Request::is('account/manage-banners/rejected')? 'btn-light': null }} px-4">Rejected</a>
    </div>
    @endif
</div>

<div class="card card-body border-0">
    <form action="{{ url()->current() }}" class="row page-search-form  mb-3">
        <div class="col-12 col-lg-5 pr-lg-0">
            <div class="form-group m-lg-0">
                <label for="search" class="sr-only">Quick Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Quick search">
            </div>
        </div>
        <div class="col-12 col-lg-4 px-lg-0">
            <div class="form-group m-lg-0">
                <label for="category" class="sr-only">Filter</label>
                <select name="category_id" class="form-control">
                    <option value="">Filter</option>
                    @foreach(Helper::categories() as $row)
                        <option value="{{ $row->id }}" {{ (request('category_id') == $row->id)? 'selected':null }}>{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-3 pl-lg-0 m-lg-0 ">
            <button type="submit" class="btn btn-primary btn-block">Search </button>
        </div>
    </form>

    <form action="{{ url()->current() }}">
        <div class="d-flex align-items-center justify-content-between mb-3">    
            <div class="form-inline page-search-form">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <div class="form-group ml-lg-0 ml-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="select_all" class="custom-control-input" id="select_all" required>
                        <label class="custom-control-label" for="select_all">Select All</label>
                    </div>
                </div>
                <div class="form-group ml-lg-3 ml-0">
                    <label for="category" class="sr-only">Bulk Action</label>
                    <select name="action" class="form-control">
                        <option value="">Bulk action</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary ml-lg-3 ml-0">Apply </button>
            </div>
            @if(request('post_id'))
            <div>
                <a class="btn btn-outline-primary"  data-toggle="modal" href="#model_feedback_form">Feedback</a>
            </div>
            @endif
        </div>

        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        @foreach($post_list as $post)
        <div class="card mt-3">
            @if(Request::is('account/manage-ads/*'))
            {!! $post->featured() !!}
            @endif
            <div class="media p-3">

                @if(Request::is('account/manage-ads/*'))
                <a href="javascript:;" 
                    style="background-image:url('{{ $post->get_featured_image() }}')"
                    class="d-block media-image align-self-center mr-5" >
                </a>

                <div class="media-body text-left">
                    @if($post->is_business())
                    <h5 class="title mt-0 mb-2"><a href="{{ url('post/'.$post->id) }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                    <div class="location font-weight-bold  mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="location">{!! $post->summary() !!}</div>
                    @else
                    <h5 class="title mt-0 mb-2"><a href="{{ url('post/'.$post->id) }}" class="text-secondary">{{ $post->post_title }}</a> </h5>
                    <div class="condition text-primary font-weight-bold mb-2">{!! ($post->condition)? $post->condition->label: null !!}</div>
                    <div class="location mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="created-at mb-2">{{ Helper::time_ago($post->created_at) }}</div>
                    <div class="price text-primary font-weight-bold"> <span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                    @endif
                </div>
                @endif

                @if(Request::is('account/manage-banners/*'))
                <div class="col text-center">
                    <img class="border" src="{{ $post->get_featured_image() }}" style="max-height:200px; max-width:100%"/>
                </div>
                @endif
            </div>
            <div class="card-footer py-2">
                <div class="row">
                    <div class="mr-5" style="min-width:300px;">
                        <div class="btn-group btn-group-sm ml-2">
                            @if(Request::is('account/manage-banners/*'))
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-eye text-primary mr-2"></i> {{ Helper::number_format($post->views) }}</a>
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-hand-pointer text-primary mr-2"></i> {{ Helper::number_format($post->clicks) }}</a>
                            @endif

                            @if(Request::is('account/manage-ads/*'))
                                
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-eye text-primary mr-2"></i> {{ Helper::number_format($post->views()->count()) }}</a>
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-heart text-primary mr-2"></i> {{ Helper::number_format($post->likes()->count()) }}</a>
                                @if($post->call_link())
                                <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->call_link() }}"><i class="fa fa-phone text-primary mr-2"></i> {{ Helper::number_format($post->calls()->count()) }}</a>
                                @endif
                                @if($post->whatsapp_link())
                                <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="fab fa-whatsapp text-primary mr-2"></i> {{ Helper::number_format($post->whatsapps()->count()) }}</a>
                                @endif
                                <a class="btn btn-light border py-1 px-2" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"><i class="fa fa-envelope text-primary mr-2"></i> {{ Helper::number_format($post->emails()->count()) }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                    @if(Request::is('account/manage-ads/*'))
                        @if($post->is_ads())
                            <a class="btn btn-primary btn-sm" href="{{ url('account/create-ads/package/'.$post->post_id) }}">Upgrade</a>
                        @else
                            <a class="btn btn-primary btn-sm" href="{{ url('account/business-profile/package/'.$post->post_id) }}">Upgrade</a>
                        @endif
                    @elseif(Request::is('account/manage-banners/*'))
                        <a class="btn btn-primary btn-sm" href="{{ url('account/create-banner/package/'.$post->advert_id) }}">Upgrade</a>
                    @endif
                    </div>
                    <div class="col">
                        <div class="custom-control custom-checkbox d-flex">
                            <input type="checkbox" name="selected[{{ $post->id }}]" class="custom-control-input" id="select_{{ $post->id }}">
                            <label class="custom-control-label" for="select_{{ $post->id }}">Select</label>
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class="btn btn-outline-dark btn-sm dropdown">
                            <span class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Request::is('account/manage-ads/*'))
                                @if($post->is_ads())
                                <a class="dropdown-item" href="{{ url('account/create-ads/details/'.$post->post_id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ url('account/manage-ads/delete/'.$post->post_id) }}" data-confirmation="Are you sure, you want to delete?">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                                @else
                                <a class="dropdown-item" href="{{ url('account/business-profile/details/'.$post->post_id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ url('account/manage-ads/delete/'.$post->post_id) }}" data-confirmation="Are you sure, you want to delete?">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                                @endif
                            @elseif(Request::is('account/manage-banners/*'))
                                <a class="dropdown-item" href="{{ url('account/create-banner/details/'.$post->advert_id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ url('account/manage-ads/delete/'.$post->advert_id) }}" data-confirmation="Are you sure, you want to delete?">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="clearfix mt-3">
            {{ $post_list->onEachSide(1)->links() }}
        </div>

        @if($post_list->count() == 0) 
        <div class="text-center p-5">
            No data found
        </div>
        @endif
    </form>
</div>

@if(request('post_id'))
@include('accounts.shared.feedback-form')
@endif

<script>
jQuery(function(){
    jQuery('.home');
})
</script>

@endsection