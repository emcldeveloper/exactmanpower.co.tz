@extends('website')

@section('title', @$post_model->post_title)
@section('page-title', @$post_model->post_title)
@section('content')
 
<section class="section-padding clearfix bg-white" id="values">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <img src="{{ @$post_model->image }}" alt="" class="w-100">
                @include('website.service._navigation')
            </div>
            <div class="col-12 col-md-7">
                <h1 class="text-primary h2 pb-4"><span>LET’S BUILD</span>  A BETTER BUSINESS TOGETHER</h1>
                <p>
                We Help you transform your business through effective use of Human Resources. We work in partnership with you to implement appropriate HR services, interventions and solutions that ultimately deliver desired outcomes for your business.
                </p>
                <hr class="border-secondary my-4">
                <p>
                {!! @$post_model->post_content !!}
                </p>
                <div class="container-fluid ">
                    <div class="card " style="border-color: #EE7822; padding: 2em;">
                        <label class="d-flex justify-content-left">
                            <i class="fas fa-bullhorn fa-2x text-primary"></i>
                        </label>
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="d-flex justify-content-center">
                                    Let us talk business today:  
                                    
                                </h2>
                            </div>
                            <div class="col-md-2 d-flex justify-content-between">
                                <h2>
                                    <a class="whatsapp-button" href="https://wa.me/+255677975251" target="_blank">
                                        <i class="fab fa-whatsapp fa-2x text-success" style="margin-top: 
                                    -9px;"></i>
                                    </a>
                                </h2>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<hr>

@include('components.clients')

@endsection
