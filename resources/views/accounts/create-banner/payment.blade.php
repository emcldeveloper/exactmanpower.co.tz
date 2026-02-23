@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.create-ads.navigation')
<style>
.active .border {
    border: 1px solid #ff8000 !important;
}
</style>

<div class="card border-0 p-4">
    <div class="text-center">
        <h4>CHOOSE PAYMENT METHOD BELOW</h4>
    </div>

    <form class="px-5" action="{{ url($route.'/payment/'.request('post_id')) }}" method="POST">
        
        {{ csrf_field() }}
        <div class="nav row my-3"  id="pills-tab" role="tablist">
            <a class="col-12 col-lg-3 nav-item nav-link active" id="pills-airtel-tab " data-toggle="pill" href="#pills-airtel" role="tab" aria-controls="pills-airtel" aria-selected="true">
                <img src="{{ asset('img/payment/airtel.png') }}" class="border rounded w-100" alt="">
            </a>
            <a class="col-12 col-lg-3 nav-item nav-link" id="pills-tigo-tab" data-toggle="pill" href="#pills-tigo" role="tab" aria-controls="pills-tigo" aria-selected="true">
                <img src="{{ asset('img/payment/tigo.png') }}" class="border w-100" alt="">
            </a>
            <a class="col-12 col-lg-3 nav-item nav-link" id="pills-mpesa-tab" data-toggle="pill" href="#pills-mpesa" role="tab" aria-controls="pills-mpesa" aria-selected="true">
                <img src="{{ asset('img/payment/mpesa.png') }}" class="border w-100" alt="">
            </a>
                
            <a class="col-12 col-lg-3 nav-item nav-link" id="pills-card-tab" data-toggle="pill" href="#pills-card" role="tab" aria-controls="pills-card" aria-selected="true">
                <img src="{{ asset('img/payment/card.png') }}" class="border w-100" alt="">
            </a>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <div  class="tab-pane active" id="pills-airtel" role="tabpanel" aria-labelledby="pills-airtel-tab">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Make a payment</h4>
                        <div class="text-light">
                            <span>Ref: 23033</span>
                            <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                        </div>
                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0"># Dial *150*60# for Airtel Money</div>
                            <div class="list-group-item px-0 py-0">1. Select Make Payments Options</div>
                            <div class="list-group-item px-0 py-0">2. Enter Business number 150150</div>
                            <div class="list-group-item px-0 py-0">3. Enter Reference and Amount</div>
                            <div class="list-group-item px-0 py-0">4. Confirm PIN</div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Confirm payment</h4>

                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0 border-top">Exact Online</div>
                            <div class="list-group-item px-0 py-0">
                                <span>Ref: 23033</span>
                                <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="customCheckDisabled1" disabled>
                            <label class="custom-control-label" for="customCheckDisabled1">I confirm payment</label>
                        </div>

                        <button type="submit" class="btn btn-primary my-1 ">Complete</button>
                    </div>
                </div>
            </div>
            <div  class="tab-pane " id="pills-tigo" role="tabpanel" aria-labelledby="pills-tigo-tab">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Make a payment</h4>
                        <div class="text-light">
                            <span>Ref: 23033</span>
                            <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                        </div>
                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0"># Dial *150*03# for TigoPesa</div>
                            <div class="list-group-item px-0 py-0">1. Select Make Payments Options</div>
                            <div class="list-group-item px-0 py-0">2. Enter Business number 150150</div>
                            <div class="list-group-item px-0 py-0">3. Enter Reference and Amount</div>
                            <div class="list-group-item px-0 py-0">4. Confirm PIN</div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Confirm payment</h4>

                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0 border-top">Exact Online</div>
                            <div class="list-group-item px-0 py-0">
                                <span>Ref: 23033</span>
                                <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="customCheckDisabled1" disabled>
                            <label class="custom-control-label" for="customCheckDisabled1">I confirm payment</label>
                        </div>

                        <button type="submit" class="btn btn-primary my-1 ">Complete</button>
                    </div>
                </div>
            </div>
            <div  class="tab-pane " id="pills-mpesa" role="tabpanel" aria-labelledby="pills-mpesa-tab">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Make a payment</h4>
                        <div class="text-light">
                            <span>Ref: 23033</span>
                            <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                        </div>
                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0"># Dial *150*00# for M-Pesa</div>
                            <div class="list-group-item px-0 py-0">1. Select Make Payments Options</div>
                            <div class="list-group-item px-0 py-0">2. Enter Business number 150150</div>
                            <div class="list-group-item px-0 py-0">3. Enter Reference and Amount</div>
                            <div class="list-group-item px-0 py-0">4. Confirm PIN</div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <h4 class="mt-2 mb-4">Confirm payment</h4>

                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0 border-top">Exact Online</div>
                            <div class="list-group-item px-0 py-0">
                                <span>Ref: 23033</span>
                                <span>Amount: TZS {{ number_format($post->category->price + $post->package->price) }}</span>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="customCheckDisabled1" disabled>
                            <label class="custom-control-label" for="customCheckDisabled1">I confirm payment</label>
                        </div>

                        <button type="submit" class="btn btn-primary my-1 ">Complete</button>
                    </div>
                </div>
            </div>
            <div  class="tab-pane " id="pills-card" role="tabpanel" aria-labelledby="pills-card-tab">
                <div class="row">
                    
                    <div class="col-12 col-lg-12">
                        <h4 class="mt-2 mb-4">Confirm payment</h4>

                        <div class="list-group list-group-flush text-light w-75">
                            <div class="list-group-item px-0 py-0 border-top">Exact Online</div>
                            <div class="list-group-item px-0 py-0">
                                <span>Ref: 23033</span>
                                <span>Amount: TZS {{ number_format($post->price) }}</span>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox my-3">
                            <input type="checkbox" class="custom-control-input" id="customCheckDisabled1" disabled>
                            <label class="custom-control-label" for="customCheckDisabled1">I confirm payment</label>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary my-1 ">Complete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-link"  data-toggle="modal" href="#model_feedback_form">Feedback</a>
        </div>
    </form>
</div>

</div>

@include('accounts.shared.feedback-form')
@endsection