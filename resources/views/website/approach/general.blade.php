@extends('website')

@section('title', $approach->post_title)
@section('page-title', $approach->post_title)
@section('content')

<section class="section-padding clearfix bg-white" id="values">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <img src="{{ $approach->image }}" alt="" class="w-100">
                @include('website.approach._navigation')
            </div>
            <div class="col-12 col-md-7">
                <h1 class="text-primary h2 pb-4"><span>LET’S BUILD</span>  A BETTER BUSINESS TOGETHER</h1>
                <p>
                We pride ourselves on providing the best support for our clients, we follow these approaches to maintain our own high standards.
                </p>
                <hr class="border-secondary my-4">
                <p>
                {!! $approach->post_content !!}
                </p>
            </div>
        </div>
    </div>
</section>
<hr>

@include('components.clients')

@endsection
