@extends('website')

@section('title', Helper::trans('general.retained_hr_services', 'Retained HR Services'))
@section('page-title', Helper::trans('general.retained_hr_services', 'Retained HR Services'))

@section('content')
<style>
.btn-light-custome {
    color: #ffffff;
    background: #33a3dc;
    border-color: #33a3dc;
    font-weight: bold;
    font-size: 20px;
    text-align: left;
}

.btn-light-custome:hover {
    color: white;
    background: #ee7822;
    border-color: #ee7822;
}
</style>

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
                We pride ourselves on providing the best support for our clients, we follow these approaches to maintain our own high standards.
                </p>
                <hr class="border-secondary my-4">
                <p>
                Exact Manpower Consulting’s retained HR service offers you a flexible way to access professional HR advice and expertise to support in realizing your organization’s goals. It provides a more predictable monthly cost with better value proposition allowing you sign up for a year and get both a reduction in our rates, and the ability to spread your costs throughout the year. Under this category you will enjoy basic HR telephone and email support, regular site visits and reviews, and longer term consultancy support.
                </p>
            </div>
        </div>
    </div>
</section>
<hr>

@include('components.clients')



@endsection
