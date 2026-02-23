@extends('website')

@section('title', Helper::trans('general.ad_hoc_services', 'Ad-Hoc Services'))
@section('page-title', Helper::trans('general.ad_hoc_services', 'Ad-Hoc Services'))

@section('content')

<section class="section-padding clearfix bg-white" id="values">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <img src="{{ url('img/contents/content-05.png') }}" alt="" class="w-100">
                @include('website.approach._navigation')
            </div>
            <div class="col-12 col-md-7">
                <h1 class="text-primary h2 pb-4"><span>LET’S BUILD</span>  A BETTER BUSINESS TOGETHER</h1>
                <p>
                We pride ourselves on providing the best support for out clients, we follow these approaches to maintain our own high standards.
                </p>
                <hr class="border-secondary my-4">
                <p>
                This is offered on “As You Need” basis. Do you simply want professional and accurate HR advice? Need a hand to implement new policies? Or have a difficult employee relation issue? Then our ad-hoc service is just what you’re looking for. You can pick up the phone and call us, or send us an e-mail and our HR professionals will be happy to help. Under this Service category, client is not tied to a contract; we’re simply there for you when you need us. With us, you have access to our professional advice, HR project implementation, documentation and management tailored to suit your needs.
                </p>
            </div>
        </div>
    </div>
</section>
<hr>

@include('components.clients')

@endsection
