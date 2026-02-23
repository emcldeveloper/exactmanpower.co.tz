@extends('customer')

@section('title', 'Package')

@section('content')

<div class="clearfix">
    <div class="container py-5">
        <!-- <h1 class="text-center">Packages</h1> -->

        <div class="clearfix text-center mt-4">
            <div class="card p-4">
                <div class="clearfix mb-4" >
                    <div class="image-profile rounded-circle border mx-auto bg-white pt-3" style="width:100px;height:100px;margin-top:-70px;"><img class="w-70" src="{{ asset('img/favicon.png') }}" alt=""></div>
                </div>
                <div class="card w-90 mx-auto p-5 mt-0">
                    <h6 class="font-weight-bold">Home Appliances, Electronics</h6>
                    <h6 class="text-light font-weight-light">This Include Electronics and Home</h6>

                    <div class="clearfix mt-4">
                        <div class="row">
                            @foreach($ads_packages_list as $row)
                            <div class="col-12 col-lg-4">
                                <div class="card p-3" style="border-left:5px solid {{ $row->background }};">
                                    <div class="row align-items-center">
                                        <div class="col ">
                                            <i class="icon-Bronze-Package fa-4x" style="color:{{ $row->background }};"></i>
                                        </div>
                                        <div class="col-8 text-left">
                                            <div style="color:{{ $row->background }};">{{ $row->name }}</div>
                                            <div class="font-weight-bold">
                                                @if($row->price == 0)
                                                <span class="text-uppercase">Free</span>
                                                @else
                                                <span>Tshs {{ number_format($row->price) }}</span>
                                                @endif
                                            </div>
                                            <div>(For {{ $row->days }} days)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card w-90 mx-auto p-5 mt-5">
                    <h4 class="font-weight-bold">WEBSITE BANNERS PACKAGES</h4>
                    <div class="row justify-content-md-center mt-5" >
                        @foreach($banner_packages_list as $row)
                        <div class="col-12 col-lg-4 mb-4">        
                            <div class="card text-center h-100 mb-3">
                                <div class="card-body py-5" style="">
                                    
                                    <div class="h4 font-weight-bold mb-4">
                                        {{ $row->type }}
                                    </div>
                                    <div class="mb-4 text-muted sm">{{ $row->descriptions }}</div>
                                    
                                </div>
                                <div class="card-body bg-light py-5">
                                    <div class="h4 mb-4 font-weight-bold">
                                        @if($row->price == 0)
                                        <span class="text-uppercase">Free</span>
                                        @else
                                        <span  class=""><span class="small">Tshs</span> {{ number_format($row->price) }}/=</span>
                                        @endif
                                    </div>
                                    <div class="my-0">
                                        Per Month
                                    </div>
                                </div>
                                <!-- <div class="card-footer bg-white border-0">
                                    <a href="javascript:;" class="btn btn-primary mb-4">Start now</a>
                                </div> -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card w-90 mx-auto p-5 mt-5">
                    <h4 class="font-weight-bold">CAMPAINS</h4>

                    <div class="row mt-4">
                        <div class="col-12 col-lg-6">
                            <div class="card h-100">
                                <div class="card-header font-weight-bold text-light">Weekly Newslatter Banner</div>
                                <div class="card-body">
                                    <div class="h4 font-weight-bold">Tshs 100,000/=</div>
                                    <div class="text-light">Per Newslatter</div>
                                    <div class="text-light px-3s">Showcase your business with Centre banner with link back to ad, business profile or your own website</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card h-100">
                                <div class="card-header font-weight-bold text-light">Mail shot</div>
                                <div class="card-body">
                                    <div class="h4 font-weight-bold">Tshs 150,000/=</div>
                                    <div class="text-light">Per Newslatter</div>
                                    <div class="text-light px-3">Showcase your business with: Announce a new product, service, event or promotion in your own styled mailshot to be send to over 100,000 subscribers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
