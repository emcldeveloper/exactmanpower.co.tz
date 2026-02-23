@extends('website')

@section('title', Helper::trans('general.out-sourced-hr-services', 'OutSourced HR Services'))
@section('page-title', Helper::trans('general.out-sourced-hr-services', 'OutSourced HR Services'))

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
                Outsourcing your HR requirements is a cost effective way of protecting yourself and your business from risks related to HR management issues. Take advantage of our knowledge, experience and expertise without adding your employee numbers.
                </p>

                <ul>
                    <li>Get the most out of your workforce</li>
                    <li>Reduce your exposure to the risk of legal fines or employee tribunals</li>
                    <li>Concentrate on running your business while we take care of your employees management.</li>
                </ul>

                <p>
                    Our outsourced services are offered either on demand or service contract basis, to best fit your business model. All our Outsourced solutions are tailored to suit your business, as every business has employment requirements and challenges that are unique.
                </p>
            </div>
        </div>
    </div>
</section>
<hr>

@include('components.clients')



@endsection
