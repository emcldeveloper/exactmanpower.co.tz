@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.create-banner.navigation')

<div class="clearfix">
    <div class="alert alert-primary text-center p-4">
        <h6 class="text-dark">Congratulations you have created your Ad</h6>
    </div>

    <div class="card h-100 mt-3">
        <div class="p-3">
            <div class="media">
                <div class="col p-0 text-center">
                    <img class="border" src="{{ $post->get_featured_image() }}" style="max-height:200px; max-width:100%"/>
                </div>
            </div>
            <div class="mt-3">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    {!! $post->category->get_tree() !!}
                </ol>
            </div>
        </div>
        <div class="card-footer py-2">
            <div class="row">
                <div class="mr-5" style="min-width:300px;">
                    <div class="btn-group btn-group-sm ml-2">
                        <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-eye text-primary mr-2"></i> {{ $post->views }}</a>
                        <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-hand-pointer text-primary mr-2"></i> {{ $post->clicks }}</a>
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
                            <a class="dropdown-item" href="{{ url($route.'/details/'.$post->advert_id) }}">Edit</a>
                            <a data-confirmation="Are you sure, you want to delete?" class="dropdown-item" href="{{ url('account/manage-ads/delete/'.$post->advert_id) }}">Delete</a>
                            <!-- <a class="dropdown-item" href="#">Submit</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">

        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="font-weight-bold">YOUR ORDER</div>
                <div>ORDER ID: <span class="font-weight-bold">{{ $post->advert_unique }}</span></div>
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
        <a class="btn btn-primary px-5" href="{{ url($route.'/payment/'.request('post_id')) }}" >Proceed with Payament</a>
    </div>
</div>

</div>

@endsection