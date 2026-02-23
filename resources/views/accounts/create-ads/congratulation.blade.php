@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">
@include('accounts.create-ads.navigation')

<div class="clearfix">
    <div class="alert alert-primary text-center p-4">
        <h6 class="text-dark">Congratulations you have created your Ad</h6>
    </div>

    <div class="card p-4 mt-4">
        <div class="card h-100">
            <div class="media p-3">
                <a href="javascript:;" 
                    style="background-image:url('{{ $post->get_featured_image() }}')"
                    class="d-block media-image align-self-center mr-5" >
                </a>
                
                <div class="media-body text-left">
                    <h5 class="title m-0"><a href="javascript:;" class="text-secondary">{{ $post->post_title }}</a> </h5>
                    <div class="condition text-primary font-weight-bold small">{!! ($post->condition)? $post->condition->label: null !!}</div>
                    <div class="location">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="created-at">{{ Helper::time_ago($post->created_at) }}</div>
                    <div class="price text-primary font-weight-bold"><span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row align-items-center">
                    <div class="d-flex align-items-center justify-content-between mr-5" style="min-width:300px;">
                        <div class="btn-group btn-group-sm ml-2">
                            <a class="btn py-1 px-2 mr-2" href="javascript:;">
                                <i class="icon-eye text-primary"></i><br/>
                                {{ $post->views()->count() }}
                            </a>
                            @if($post->call_link())
                            <a class="btn py-1 px-2 mr-2" href="{{ $post->call_link() }}">
                                <i class="icon-Call text-primary"></i><br>
                                {{ $post->calls()->count() }}
                            </a>
                            @endif
                            @if($post->whatsapp_link())
                            <a class="btn py-1 px-2 mr-2" href="{{ $post->whatsapp_link() }}" target="_blank">
                                <i class="icon-whatsapp1 text-primary"></i><br>
                                {{ $post->whatsapps()->count() }}
                            </a>
                            @endif
                            <a class="btn py-1 px-2" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}">
                                <i class="icon-My-Messages text-primary"></i><br>
                                {{ $post->emails()->count() }}
                            </a>
                        </div>
                        <div class="text-primary">
                            {{ ($post->package)? $post->package->name: null }}
                        </div>
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
                                <a class="dropdown-item" href="{{ url($route.'/details/'.$post->post_id) }}">Edit</a>
                                <a data-confirmation="Are you sure, you want to delete?" class="dropdown-item" href="{{ url($route.'/delete/'.$post->post_id) }}">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                {!! $post->category->get_tree() !!}
            </ol>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="font-weight-bold">YOUR ORDER</div>
                <div>ORDER ID: <span class="font-weight-bold">{{ $post->post_unique }}</span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">Category price</div>
                <div class="col">Tshs {{ number_format($post->category->price) }}</div>
            </div>
            <div class="row">
                <div class="col-4">Promotion</div>
                <div class="col">Tshs {{ number_format($post->package->price) }}</div>
            </div>
        </div>
        <div class="card-footer font-weight-bold">
            <div class="row">
                <div class="col-4">Total</div>
                <div class="col">Tshs {{ number_format($post->category->price + $post->package->price) }}</div>
            </div>
        </div>
    </div>

    <div class="clearfix text-center mt-4">
        @if(($post->category->price + $post->package->price)) 
            <a class="btn btn-primary px-5" href="{{ url($route.'/payment/'.request('post_id')) }}" >Proceed with Payament</a>
        @else
            <a class="btn btn-primary px-5" href="{{ $route_action }}" >Proceed with Management</a>
        @endif
    </div>
</div>

@if(!($post->category->price + $post->package->price))
<div class="text-center mt-4">
    <a class="btn btn-link"  data-toggle="modal" href="#model_feedback_form">Feedback</a>
</div>
@include('accounts.shared.feedback-form')
@endif
</div>

@endsection