@extends('website')

@section('title', 'Home')

@section('content')
@livewireStyles
<style>
.main-viewport {
    z-index: 2;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    /* height: calc(100% - 95px) !important; */
}

.carousel-indicators {
    margin-bottom: 110px;
}

.carousel-indicators li {
    width: 16px;
    height: 16px;
    border-radius: 16px;
    overflow: hidden;
    border-top: none;
    border-bottom: none;
    background-color: #ee7822;
    opacity: .3;
    margin-right: 6px;
    margin-left: 6px;
}

.carousel-caption {
    bottom: 190px;
    right: 10%;
    left: 10%;
    text-transform: normal;
    font-weight: bold;
    text-align: left;
}
.carousel-caption * {
    text-transform: none; 
    font-size: 3.0rem;
    text-shadow: 2px 2px 4px #969696;
}

.btn-light-custome {
    color:#33a3dc;
    background: white;
    border-color: white;
    font-weight: bold;
    font-size: 20px;
    text-align: left;
}

.btn-light-custome:hover {
    color: white;
    background: #ee7822;
    border-color: #ee7822;
}





.social-btn-sp #social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    .social-btn-sp #social-links ul li {
        display: inline-block;
    }          
    .social-btn-sp #social-links ul li a {
        padding: 15px;
        border: 1px solid #ccc;
        margin: 1px;
        font-size: 30px;
        border: none;

    }
    table #social-links{
        display: inline-table;
        border: none;
        margin-top: -2em;
        margin-left: -4em;
    }
    table #social-links ul li{

        display: inline;
        padding: 0.1em;
    }
    table #social-links ul li a{

        padding: 6px;
        background-color: #EE7822;
        font-size: 18px;
        color: #FFFFFF;
        border-radius: 30em;
    }
</style>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
     
    <div class="carousel-inner">
        <?php
            $slider = \App\Models\Post::where('post_type_id', 'slider')->where('post_status','1')->count();
         ?>
        @if($slider  >= "2")
        @foreach(\App\Models\Post::where('post_type_id', 'slider')->get() as $index => $row)
        @if($row->post_status!="0")
            
            <div class="carousel-item  {{ ($index == 0)? 'active': ''}}" style="background:url('{{ $row->image }}'); background-repeat:no-repeat; background-size:contain; background-position:center;">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="display-4 font-weight-normal text-secondary mb-0">{!! $row->post_title !!} </h5>
                    <p class="display-4 defaut-font text-primary font-weight-bold">{!! $row->post_content !!}</p>
                </div>
            </div>
        
        @endif
        @endforeach
        @else
        
        <div class="carousel-item active" style="background:url('{{ asset('img/sliders/slider-1.png') }}')">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-4 font-weight-normal text-secondary mb-0 ">Giving you <br/> the right Solution</h5>
                <p class="display-4 defaut-font text-primary font-weight-bold">To Your Business</p>
            </div>
        </div>

        <div class="carousel-item" style="background:url('{{ asset('img/sliders/slider-2.png') }}')">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-4 font-weight-normal text-secondary mb-0 ">Your Reliable <br/> HR Partners</h5>
                <p class="display-4 defaut-font text-primary font-weight-bold">For Business Success</p>
            </div>
        </div>

        <div class="carousel-item" style="background:url('{{ asset('img/sliders/slider-3.png') }}')">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-4 font-weight-normal text-secondary mb-0 ">We Offer a <br/> Tailored Approach</h5>
                <p class="display-4 defaut-font text-primary font-weight-bold">Meeting your Client Need</p>
            </div>
        </div>

        @endif
    </div>
    <ol class="carousel-indicators">
        @if(isset($sliders_list) && $sliders_list->count() > 0 && false)
        @foreach($sliders_list as $index => $row)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ ($index == 0)? 'active': ''}}"></li>
        @endforeach
        @else
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        @endif
        
    </ol>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="clearfix bg-dotted" style="background:rgba(10, 103, 189, 0.8);">
    <div class="text-white  section-padding">
        <div class="container text-center ">
            <h2 class="text-primary-light">Welcome to Exact Manpower Ltd</h2>
        </div>
        <div class="container mt-4">
            <div class="row justify-content-center text-center">
                <?php 
                    $count_welcome = \App\Models\Post::where('post_type_id','Welcome-Note')->where('post_status','1')->latest()->count();
                 ?>
                @if($count_welcome >= 3) 
               <div class="col-md-10">
                   <div class="row justify-content-center text-center">
                       @foreach(\App\Models\Post::where('post_type_id','Welcome-Note')->where('post_status','1')->latest()->paginate(3) as $welcome)

                       <?php $rem= (float)($welcome->id / 2); $val = ($rem - (int)$rem)*2; ?>

                        <div class="col-12 col-lg-4">
                            <img src="{{ asset($welcome->image) }}" width="100%" alt="" srcset="" class="bg-image mx-auto  " style="width:100px; height:100px;margin-top:0px; border:0px solid; z-index: 1;">
                            <div class="h4 mt-4 d-flex justify-content-center" style="width: 80%; ">{{$welcome->post_title}}</div>
                            <div style="margin-top: 10%;" class="clearfix">
                                <a href="{{ $welcome->post_summary }}" target="_blank" class="btn @if($val=='1') btn-primary @elseif($val == '0') btn-danger @elseif($val=='1' || $val=='0') btn-secondary @endif btn-lg rounded-pill py-3 mx-4 mb-3">{{$welcome->btn_name}}</a>
                            </div>
                        </div>
                        @endforeach
                   </div>
               </div>
 
                @else
                <div class="col-12 col-lg-3">
                    <img src="{{ url('img/icons/welcome1.png') }}" alt="" srcset="">
                    <div class="h4 mt-4">More then <span class="text-primary-light">100+</span> <br>Visitors everyday</div>
                </div>

                <div class="col-12 col-lg-3">
                    <img src="{{ url('img/icons/welcome2.png') }}" alt="" srcset="">
                    <div class="h4 mt-4">Reliable HR Service <br>provider in Tanzania.</div>
                </div>

                <div class="col-12 col-lg-3">
                    <img src="{{ url('img/icons/welcome3.png') }}" alt="" srcset="">
                    <div class="h4 mt-4"><span class="text-primary-light">24 / 7</span> <br> Support</div>
                </div>
                
            </div>
            <div class="text-center mt-4">
                <div class="d-inline-block">
                    <a href="{{ url('about') }}" class="btn btn-secondary btn-lg rounded-pill py-3 mx-4 mb-3">About Us</a>
                    <a href="https://ekazi.co.tz/" class="btn btn-primary btn-lg rounded-pill py-3 mx-4 mb-3">Job Vacancies</a>
                    <a href="https://emclportal.co.tz/" class="btn btn-danger btn-lg rounded-pill py-3 mx-4 mb-3">Employer Zone</a>
                </div>
            </div>
            @endif
        </div>
    </div>  
</div>
@if(false)
<div class="clearfix bg-white">
    <div class="section-padding">
        <div class="container">
            <div class="row justify-content-center text-center text-secondary">
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat1.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Accountancy </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat2.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Agriculture </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat3.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Education </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat4.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Fashion </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat5.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Photographer </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="clearfix d-inline-block bg-secondary rounded-circle p-2">
                        <img width="70" src="{{ url('img/icons/cat6.png') }}" alt="" srcset="">
                    </div>
                    <div class="h4 mt-4">Technician </div>
                </div>
            </div>
            
        </div>
    </div>  
</div>
@endif
@if(false)
<div class="clearfix bg-default">
    <div class="section-padding">
        <div class="container text-center ">
            <h2 class="text-secondary">How It Works</h2>
        </div>
        <div class="container pt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">
                    <div class="row text-center text-secondary">
                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-secondary rounded-circle p-3">
                                <img width="40" src="{{ url('img/icons/how1.svg') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Create <br>an Account </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-success rounded-circle p-3">
                                <img class="px-1" height="40" src="{{ url('img/icons/how2.svg') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Complete <br>your profile </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-primary rounded-circle p-3">
                                <img width="40" src="{{ url('img/icons/how3.svg') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Search <br>your job </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-danger rounded-circle p-3">
                                <img width="40" src="{{ url('img/icons/how4.svg') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Apply <br>for job </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 text-center text-md-left">
                    <a class="btn btn-danger btn-lg rounded-pill text-white py-3 mx-4">Start Now</a>
                </div>
            </div>
            
        </div>
    </div>  
</div>
@endif

<div class="clearfix bg-secondary bg-image" style="background-image:url({{ url('img/Background-footer.png') }});">
    <div class="section-padding text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12">
                    <div class="row text-center">

                        {{--<div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-success  rounded-circle p-2">
                                <img width="70" src="{{ url('img/icons/service1.png') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Recruitment <br>Services </div>
                        </div>

                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-success rounded-circle p-2">
                                <img width="70" src="{{ url('img/icons/service2.png') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">HR <br>Services </div>
                        </div>

                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-success rounded-circle p-2">
                                <img width="70" src="{{ url('img/icons/service3.png') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Indutrial<br>Services </div>
                        </div>

                        <div class="col-12 col-lg-3">
                            <div class="clearfix d-inline-block bg-success rounded-circle p-2">
                                <img width="70" src="{{ url('img/icons/service4.png') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">HR Legal<br>Compliance<br>/Advice </div>
                        </div>
                        <div class="col-12 col-lg-3 text-center">
                            <div class="clearfix d-inline-block bg-success rounded-circle p-2">
                                <img width="70" src="{{ url('img/icons/service5.png') }}" alt="" srcset="">
                            </div>
                            <div class="h4 mt-4">Payroll<br>Services </div>
                        </div> --}}
                        <?php $count = 0; ?>
                        @foreach(App\Models\Post::latest()->get() as $service)
                            @if($service->post_type_id == "service" && $service->is_active =="true")
                            <?php if($count == 6 ) break; ?>
                                <div class="col-12 col-lg-2 text-center">
                                    <div class="clearfix d-inline-block bg-success rounded-circle p-2">
                                        <img width="70" src="{{ $service->icon }}" class="ml-2" alt="...">
                                    </div>
                                    <a href="{{ url('services/'.$service->post_slug) }}" >
                                        <div class="h4 mt-4">{{$service->post_title}} </div>
                                    </a>
                                </div> 
                           <?php $count++; ?>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ url('services') }}" class="btn btn-primary btn-lg rounded-pill text-white py-3 mx-4">More Services</a>
            </div>
        </div>
    </div>  
</div>


<div class="col-md-12 bg-light">
    {{-- @include('components.clients') --}}
    @livewire('home.clients')
</div>

<div class="clearfix bg-secondary bg-image" style="background-image:url( {{ url('img/Background-footer.png') }});">
    <div class="section-padding text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6">
                    <h2>Our Approaches</h2>
                    <div class="clearfix mt-4">
                        <div class="pb-4" style="font-size: 18px;">We focus on the outcomes of our interventions on your business, and that is our value position.</div>
                        <div class="row">
                            <div class="col-12 col-md-7">
                                @foreach(\App\Models\Post::where('post_type_id','our-approach')->paginate(5) as $approach)
                                <a href="{{ url('approach/'.$approach->id) }}" class="btn btn-light-custome btn-block mb-2">{{$approach->post_title}}</a>
                                @endforeach
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="mb-2">Do you simply want professional and accurate HR advice?</div>
                                <?php 
                                    $more = \App\Models\Post::where('post_type_id','our-approach')->first();
                                 ?>
                                 @if(isset($more->id))
                                <a href="{{ url('approach/'.$more->id) }}" class="btn btn-outline-light rounded-pill mb-2">Read More</a>
                                @else
                                <a href="#" class="btn btn-outline-light rounded-pill mb-2">Read More</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <h2>What Clients Say!</h2>
                    <div class="clearfix pt-4  px-0 px-md-2">
                        <div class="card card-body  d-flex customer-says" style="background-color:rgba(255,255,255,0.3);border-radius:20px;font-size:18px;margin-top:0px;">

                            @include('admin.posts.home.testimony') 
 
                             {{-- <div class="">
                                <div class="bg-image mx-auto rounded-circle border-white" style="
                                    background-image:url('{{ asset('img/avatar-placeholder.jpg') }}');
                                    width:100px; height:100px;
                                    margin-top:-55px; margin-bottom:30px;
                                    border:3px solid;">
                                </div>
                                
                                <p class="clearfix"><img class="mb-2 mr-2" src="{{ asset('img/icons/quet.svg') }}" width="30" alt="">
                                I found a job as a Web Developer and applied through my iPhone with the JobsFactory website! It’s very easy to search for jobs and apply here!</p>

                            </div> --}}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<div class=" bg-light text-dark" {{-- style="background-image:url( {{ url('img/Background-footer.png') }});" --}}>
    <div class="section-padding text-dark">
        @livewire('home.team')
        {{-- @include('components.team')-- }}
        </div>
    </div>  
</div>


<div class="clearfix bg-primary bg-image" style="background-image:url({{ url('img/Background-footer.png') }});">
    <div class="section-padding text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
                    <h5>Come to our Office</h5>
                    <p>Exact Manpower Consulting ltd<br>
                    3rd Floor,The Arcade,Mwai kibaki Rd,<br>
                    Mikocheni, P. O. Box 105061<br>
                    Dar es Salaam,Tanzania</p>
                </div>
                <div class="col-12 col-lg-2">
                    <h5>Want to meet?</h5>
                    <p>Monday - Saturday<br>8am - 17pm</p>
                </div>
                <div class="col-12 col-lg-3">
                    <h5>Need assistance? Call Us:</h5>
                    <div>
                        <div class="font-weight-bold">General Office</div>
                        <div>+255-677-975-251  <br>+255-715-800-430</div>
                        <div>Email: info@exactmanpower.co.tz</div>
                        <br>
                        <div class="font-weight-bold">Recruitment</div>
                        <div> +255-785-014-718 <br>+255-677-400-205/206</div>
                        <div>Email: recruitment@exactmanpower.co.tz</div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <a href="{{ url('contact') }}" class="btn btn-secondary btn-lg mb-4">Contact Us</a>
                    <br>
                    <a href="https://wa.me/+255677975251" class="whatsapp-button" target="_blank">
                                        <i class="fab fa-whatsapp fa-2x text-light" style="margin-top: 
                                    -7px;"></i> Online Support
                    </a>
                    {{-- <a href="{{ url('contact') }}" class="text-white"><img src="{{ asset('img/icons/online-support.svg') }}" width="20" alt=""> Online Support</a> --}}
                </div>
            </div>
        </div>
    </div>  
</div>
@livewireScripts

<script>
jQuery(document).ready(function(){

    if(jQuery.fn.slick) {
        // jQuery('.customer-says').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     autoplay: true,
        //     autoplaySpeed: 1500,
        //     arrows: false,
        //     dots: false,
        //     pauseOnHover: false,
        //     responsive: [{
        //         breakpoint: 768,
        //         settings: {
        //             slidesToShow: 4
        //         }
        //     }, {
        //         breakpoint: 520,
        //         settings: {
        //             slidesToShow: 3
        //         }
        //     }]
        // });
    }
    
});
</script>
@endsection
