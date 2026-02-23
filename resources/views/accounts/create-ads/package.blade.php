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

            <!----- Include view from components/alert----->
            @component('components.alert')@endcomponent
            <!----- End include view from components/alert----->

            <div class="row mt-5" >
                @foreach($packages_list as $row)
                <div class="col-12 col-lg-4 mb-5 mb-lg-5">        
                    <div class="card text-center h-100 mb-5">
                        <div class="card-body" style="background-color:{{ $row->background }};color:{{ $row->color }}">
                            <div class="clearfix mb-4" >
                                <div class="image-profile rounded-circle border mx-auto bg-white pt-4" style="width:100px;height:100px;margin-top:-70px;border-color:{{ $row->background }} !important;"><i class="icon-Bronze-Package fa-3x" style="color:{{ $row->background }}"></i></div>
                            </div>
                            <div class="h5 font-weight-bold mb-5">
                                {{ $row->name }}
                            </div>
                            <div class="h6 mb-4">
                                @if($row->price == 0)
                                <span class="text-uppercase">Free</span>
                                @else
                                <span  class=""><span class="small">Tshs</span> {{ number_format($row->price) }}/=</span>
                                @endif
                            </div>
                            <div class="my-0">
                                For {{ $row->days }} days
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $row->descriptions }}
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="custom-control custom-radio my-1 mr-sm-2">
                                <input type="radio" class="custom-control-input" name="package_id" value="{{ $row->package_id }}" id="package-{{ $row->package_id }}" {{ ($post && $post->package_id == $row->package_id )? 'checked':null }}>
                                <label class="custom-control-label" for="package-{{ $row->package_id }}">
                                    <span class="d-block">Select</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-4">
            <a class="btn btn-light border px-5" href="{{ url($route.'/photos/'.request('post_id')) }}">Back</a>
            <button type="submit" class="btn btn-primary px-5">Next</button>
        </div>
    </form>

</div>
@endsection