@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

    @include('accounts.create-ads.navigation')

    <form action="{{ url($route.'/package/'.request('post_id')) }}" method="POST">
        {{ csrf_field() }}
        <div class="bg-white p-4">
            <div class="text-center py-3">
                <h4 class="m-0">SELECT PACKAGE</h4>
            </div>
        </div>

        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        @foreach($packages_list as $row)
        <div class="mt-4">        
            <div class="clearfix">
                <div class="card h-100">
                    <div class="card-header bg-white d-flex justify-content-between  align-items-center">
                        <div class="h4 my-0">
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input type="radio" class="custom-control-input" name="package_id" value="{{ $row->package_id }}" id="package-{{ $row->package_id }}" {{ ($post->package_id == $row->package_id )? 'checked':null }}>
                                <label class="custom-control-label" for="package-{{ $row->package_id }}">
                                    {{ $row->name }} | 
                                    @if($row->price == 0)
                                    <span class="text-primary">Free</span>
                                    @else
                                    <span  class="text-primary">Tshs {{ number_format($row->price) }}/=</span>
                                    @endif
                                    <span class="d-block small">{{ $row->descriptions }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="h4 my-0">
                            {{ $row->days }} days
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="media">
                            <span 
                                style="background-image:url('{{ asset('img/placeholder.png') }}')"
                                class="d-block media-image align-self-center mr-5" >
                            </span>
                            
                            <div class="media-body text-left">
                                <h5 class="title m-0"><a href="javascript:;" class="text-secondary">{{ $post->post_title }}</a> </h5>
                                <div class="condition text-primary font-weight-bold ">New</div>
                                <div class="location ">Dar es salam</div>
                                <div class="created-at ">Today</div>
                                <div class="price text-primary font-weight-bold">TZS {{ number_format($post->price) }}/=</div>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="col-5 mr-5 p-0">
                                <div class="btn-group btn-group-sm">
                                    <a class="btn btn-circle btn-light text-light p-1" href="#"><i class="fa fa-phone"></i></a>
                                    <a class="btn btn-circle btn-light text-light p-1 mx-2" href="#"><i class="fab fa-whatsapp"></i></a>
                                    <a class="btn btn-circle btn-light text-light p-1" href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                            <div>
                                <div class="btn-group btn-group-sm">
                                    <a class="btn text-light p-1" href="#"><i class="fa fa-heart"></i></a>
                                    <a class="btn text-light p-1" href="#"><i class="fa fa-star"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-center mt-4">
            <a class="btn btn-light border px-5" href="{{ url($route.'/photos/'.request('post_id')) }}">Back</a>
            <button type="submit" class="btn btn-primary px-5">Next</button>
        </div>
    </form>

</div>

@endsection