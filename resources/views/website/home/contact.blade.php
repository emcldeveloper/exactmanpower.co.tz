@extends('website')

@section('title', 'Contact')
@section('page-title', 'Contact')

@section('content')

<style>
.form-control-lg, .btn-lg {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
    height: calc(1.5em + 2rem + 2px);
}

</style>

<div class="clearfix">
    <div class="card border-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31696.398118093515!2d39.257841!3d-6.763787!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4c35f252ce81%3A0xdd3947d3909461c9!2sArcade+Building%2C+Mwai+Kibaki+Rd%2C+Dar+es+Salaam%2C+Tanzania!5e0!3m2!1sen!2sus!4v1524241353741" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
</div>

<div class="clearfix section-padding">
    <div class="container">
        <div class="bg-default p-5">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="text-center">
                        <div class="clearfix d-inline-block bg-primary rounded-circle p-2">
                            <img width="120" src="{{ url('img/icons/service1.png') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class="p-3 p-md-0 text-center">
                        <h1 class="text-secondary p-3 p-md-0 my-4 " style="font-size:2.5rem;">Exact Manpower Consulting Ltd</h1>

                        <div class="h4 text-secondary font-weight-light px-4">
                            <address>
                            3rd Floor, The Arcade,<br>
                            Mwai kibaki Rd, Mikocheni,<br>
                            P.O.Box 105061, Dar es Salaam, Tanzania.<br/>
                            </address>
                            <div>
                                <div class="font-weight-bold">General Office</div>
                                <div>+255-677-975-251 | +255-715-800-430</div>
                                <div>{{ Helper::trans('general.email', 'Email') }}: info@exactmanpower.co.tz</div>
                                <br>
                                <div class="font-weight-bold">Recruitment</div>
                                <div> +255-785-014-718 | +255-677-400-205/206</div>
                                <div>{{ Helper::trans('general.email', 'Email') }}: recruitment@exactmanpower.co.tz</div>
                            </div>
                        </div>
                        <div class="social-links outline text-center mt-4">
                            <a class="btn btn-primary btn-circle" href="https://facebook.com/exactmanpower"
                                target="_blank">
                                <i class="fab fa-facebook-f fa-1x"></i>
                            </a>
                            <a class="btn btn-primary btn-circle" href="https://twitter.com/exactmanpower"
                                target="_blank">
                                <i class="fab fa-twitter fa-1x"></i>
                            </a>
                            <a class="btn btn-primary btn-circle" href="https://www.instagram.com/exactmanpower"
                                target="_blank">
                                <i class="fab fa-instagram fa-1x"></i>
                            </a>
                            <a class="btn btn-primary btn-circle" href="https://www.linkedin.com/company/exact-manpower-consulting"
                                target="_blank">
                                <i class="fab fa-linkedin fa-1x"></i>
                            </a>
                            <!-- <a class="btn btn-primary btn-circle" href="https://wa.me/{{ config('app.phone') }}?text=Hi, I'm interested" target="_blank">
                                <i class="fab fa-whatsapp fa-1x"></i>
                            </a> -->
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <h1 class="text-secondary p-3 p-md-0 mb-3 ">Send us a message</h1>
                    <form class="p-3 p-md-0" method="POST" action="{{ url('contact') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- <label>{{ Helper::trans('general.your_name', 'Your Name') }}</label> -->
                            <input name="name" type="text" class="form-control form-control-lg border-secondary" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <!-- <label>{{ Helper::trans('general.email_address', 'Email address') }}</label> -->
                            <input name="email" type="email" class="form-control form-control-lg border-secondary" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <!-- <label>{{ Helper::trans('general.subject', 'Subject') }}</label> -->
                            <input name="subject" type="text" class="form-control form-control-lg border-secondary" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <!-- <label>{{ Helper::trans('general.message', 'Message') }}</label> -->
                            <textarea name="message" class="form-control form-control-lg border-secondary" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block btn-lg">{{ Helper::trans('general.send', 'Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
