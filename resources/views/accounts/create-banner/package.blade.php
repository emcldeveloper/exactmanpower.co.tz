@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.create-banner.navigation')

<form action="{{ url($route.'/package/'.request('post_id')) }}" method="POST">
    {{ csrf_field() }}
    <div class="bg-white p-4">
        <div class="text-center py-3">
            <h4 class="m-0">SELECT PACKAGE</h4>
        </div>

        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row mt-5" >
            @foreach($packages_list as $row)
            <div class="col-12 col-lg-4 mb-5 mb-lg-5" style="margin-bottom:0px;">        
                <div class="card text-center h-100 mb-5">
                    <div class="card-body border border-white" style="color:{{ $row->color }};background-color:{{ $row->background }}">
                        <!-- <div class="clearfix mb-4" >
                            <div class="image-profile rounded-circle border mx-auto bg-white pt-4" style="width:100px;height:100px;margin-top:-70px;border-color:{{ $row->background }} !important;"><i class="icon-Bronze-Package fa-3x" style="color:{{ $row->background }}"></i></div>
                        </div> -->
                        <div class="h6 font-weight-bold mt-4">
                            {{ $row->type }}
                        </div>
                        <div class="small mb-4">{{ $row->descriptions }}</div>
                        <div class="h5 font-weight-bold mb-4">
                            @if($row->price == 0)
                            <span class="text-uppercase">Free</span>
                            @else
                            <span  class=" text-primary"><span class="small">Tshs</span> {{ number_format($row->price) }}/=</span>
                            @endif
                        </div>
                        <div class="my-0">
                            {{ $row->days }} days
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $row->descriptions }}
                    </div>
                    <div class="card-footer bg-white border-0">
                        <div class="custom-control custom-radio my-1 mr-sm-2">
                            <input type="radio" class="custom-control-input" name="package_id" value="{{ $row->advert_category_id }}" id="package-{{ $row->advert_category_id }}" {{ ($post && $post->advert_category_id == $row->advert_category_id )? 'checked':null }}>
                            <label class="custom-control-label" for="package-{{ $row->advert_category_id }}">
                                <span class="d-block">Select</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-5">Next</button>
        </div>
    </div>
</form>

</div>

@endsection