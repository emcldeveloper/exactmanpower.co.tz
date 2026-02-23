

<!-- <hr class="mb-0"> -->

<div class="footer-address-links clearfix bg-dark text-light">
    <div class="container section-padding text-left">
        <div class="row mx-0">
            <div class="col-12 col-lg-8">
                <h4 class="my-0">Newsletter Subscription</h4>
            </div>
            <div class="col-12 col-lg-4 d-none d-md-flex text-center align-items-center justify-content-between">
                <h4 class="my-0">Follow us</h4>
                <div class="social-links outline text-center text-md-left my-0 text-white">
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://facebook.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-facebook-f fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://twitter.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-twitter fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://www.instagram.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-instagram fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://www.linkedin.com/in/exactmanpower"
                        target="_blank">
                        <i class="fab fa-linkedin fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm" href="https://wa.me/{{ config('app.phone') }}?text=Hi, I'm interested" target="_blank">
                        <i class="fab fa-whatsapp fa-1x"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col"><hr class="bg-light border-light"/></div>
        
        <div class="row mx-0">
            <div class="col-12 col-lg-8 text-center text-md-left">
                <div class="text-center text-md-left px-0 px-md-0 mb-5 mb-md-0">
                    <div class=" text-justify mb-4" style="line-height:1.5;">
                        <div>Leave us your Email to get all the latest updates from us.</div>                      
                        <div>No worries, we don’t spam.</div>                      
                    </div>
                    <div class="d-block d-md-flex form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Your Name" id="_input_name">
                            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                        </div>
                        <div class="form-group ml-0 ml-md-3">
                            <input type="email" class="form-control {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ old('email') }}" placeholder="Email Address" id="_input_email">
                            <div class="invalid-feedback" id="_input_help_email">{{ $errors->has('email')? $errors->first('email'): null }}</div>
                        </div>
                        <button class="btn btn-primary ml-0 ml-md-3" type="submit"> Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-block d-md-none text-center align-items-center justify-content-between mb-4">
                <h4 class="my-3">Follow us</h4>
                <div class="social-links outline text-center text-md-left my-0 text-white">
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://facebook.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-facebook-f fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://twitter.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-twitter fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://www.instagram.com/exactmanpower"
                        target="_blank">
                        <i class="fab fa-instagram fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm mr-1" href="https://www.linkedin.com/company/exact-manpower-consulting"
                        target="_blank">
                        <i class="fab fa-linkedin fa-1x"></i>
                    </a>
                    <a class="btn btn-light btn-circle btn-sm" href="https://wa.me/{{ config('app.phone') }}?text=Hi, I'm interested" target="_blank">
                        <i class="fab fa-whatsapp fa-1x"></i>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-4 text-center text-md-left">
                <div class="row text-uppercase">
                    <div class="col-12 col-lg-6">
                        <div class="text-center text-md-left">
                            <ul class="list-unstyled">
                                <li><a class="" href="{{ url('/') }}">Home</a></li>
                                {{-- <li><a class="" href="{{ url('services') }}">Sevices</a></li>
                                <li><a class="" href="{{ url('our-approach') }}">Our Approach</a></li> --}}
                                <li><a class="" href="https://ekazi.co.tz">Jobs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="text-center text-md-left">
                            <ul class="list-unstyled">
                                {{-- <li><a class="" href="{{ url('hr-services') }}">{{ Helper::trans('footer.hr_services', 'HR Services') }}</a></li> --}}
                                <li><a class="" href="{{ url('newsroom') }}">Newsroom</a></li>
                                <li><a class="" href="{{ url('contact') }}">Contact Us</a></li>
                                {{-- <li><a class="" href="{{ url('faq') }}">FAQ</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="footer-copyright clearfix bg-secondary text-white ">
    <div class="container py-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-md-12 m-0 text-center">
                &copy; <a href="https://exactmanpower.co.tz" target="_blank">exactmanpower.co.tz</a> {{ 2014}} - {{ date('Y', time()) }},
                All rights reserved. 
                {{-- Helper::trans('footer.developed_by', 'Developed by') --}}
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="model_subscription_thanks" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="overflow:hidden;">
            <div class="modal-body {{ session('modal_alert') }}">
                <div class="d-flex align-items-center justify-content-between {{ session('modal_alert')? :'text-primary' }} ">
                    @if(session('modal_title'))
                    <h5 class="modal-title">{{ session('modal_title') }}</h5>
                    @endif
                    <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="clearfix" style="font-size:16px;">
                    @if(session('modal_content'))
                        {!! session('modal_content') !!}
                    @endif
                    @if(session('modal_link'))
                    <div class="clearfix text-right mt-3">
                        <a href="{{ session('modal_link') }}" class="btn btn-primary">{{ session('modal_link_title')? session('modal_link_title'):'Continue' }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="ThrobberContainer"><canvas height="100" width="100" style="width: 100px; height: 100px; display: none;"></canvas></div>

@if(false)
@include('components.socket')
@endif

<script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/handlebars.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/taginput/jquery-tagsinput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script>
jQuery(function(){
    @if(session('modal_title') || session('modal_content'))
        jQuery('#model_subscription_thanks').modal('show');
    @endif

    function reset_menu_sticky(pos) {
        if(pos > 100 && !jQuery('body').hasClass('sticky')) {
            jQuery('body').addClass('sticky');
        } else if(pos <= 50 && jQuery('body').hasClass('sticky')) {
            jQuery('body').removeClass('sticky');
        }
    }

    var pos = window.pageYOffset;
    reset_menu_sticky(pos);
    document.body.onscroll = function(e){
        pos = this.pageYOffset;
        reset_menu_sticky(pos);
    }

    // atr.components.common.loadLazyComponents();
    // atr.multimedia.initMultimediaViewer();
    // atr.common.resizeBackground();

    // jQuery(function() {
    //     atr.components.sliders.initSliderPositionsForCurrentPage();
    // });
    
    // if (atr.common.userIsOnMobile() === true) {
    //     console.log('mobile');
    //     jQuery('body').addClass('mobile');
    // } else if(atr.common.userIsOnTablet() === true){
    //     console.log('tablet');
    //     jQuery('body').addClass('tablet');
    // } else {
    //     console.log('desktop');
    // }
})

</script>

@php
Session::forget(['modal_title', 'modal_content', 'modal_link']);
@endphp
</body>

</html>
