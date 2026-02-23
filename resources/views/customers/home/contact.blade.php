@extends('customer')

@section('title', 'Payments')

@section('content')


<div class="clearfix">
    <div class="container section-padding">
        <h1 class="mb-3 px-3 px-lg-0">Contact</h1>
        <div class="row align-items-center">
            <div class="col-12 col-lg-7">
                <div class="p-3 p-lg-0">
                    <form class="" method="POST" action="{{ url('page/contact') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email address</label>
                            <input name="email" type="email" class="form-control" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="colo-12 col-lg-5">
                <div class="p-3 p-lg-0">
                    <address>
                        Exact Online, 3rd Floor, <br/>
                        The Arcade, Mwai kibaki Rd, Mikocheni, <br/>
                        P.O.Box 106242 <br/>
                        Dar es Salaam, Tanzania.
                    </address>
                    <div>Email: info@exctonline.co.tz</div>
                    <div>Phone: {{ config('app.phone') }}</div>
                    <div class="social-links outline text-center text-lg-left mt-4">
                        <a class="btn btn-outline-twitter btn-circle" href="https://twitter.com/exctonlinetz"
                            target="_blank">
                            <i class="fab fa-twitter fa-1x"></i>
                        </a>
                        <a class="btn btn-outline-facebook btn-circle" href="https://facebook.com/exctonlinetz"
                            target="_blank">
                            <i class="fab fa-facebook-f fa-1x"></i>
                        </a>
                        <a class="btn btn-outline-instagram btn-circle" href="https://instagram.com/exctonlinetz" target="_blank">
                            <i class="fab fa-instagram fa-1x"></i>
                        </a>
                        <a class="btn btn-outline-success btn-circle" href="https://wa.me/{{ config('app.phone') }}?text=Hi, I'm interested" target="_blank">
                            <i class="fab fa-whatsapp fa-1x"></i>
                        </a>
                        <!-- <a class="btn btn-google btn-circle" href="https://plus.google.com/exctonlinetz" target="_blank">
                            <i class="fab fa-google-plus-g fa-1x"></i>
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix">
    <div class="card">
        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.961298247319!2d39.23898821518732!3d-6.774565195103095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4e7db8c80bf5%3A0x2de5a8ecc5ebb87b!2sTiME+Tickets!5e0!3m2!1sen!2stz!4v1495820491133"frameborder="0" height="400" style="border:0" width="100%"></iframe> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31696.398118093515!2d39.257841!3d-6.763787!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4c35f252ce81%3A0xdd3947d3909461c9!2sArcade+Building%2C+Mwai+Kibaki+Rd%2C+Dar+es+Salaam%2C+Tanzania!5e0!3m2!1sen!2sus!4v1524241353741" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen=""></iframe>
    </div>
</div>

@endsection
