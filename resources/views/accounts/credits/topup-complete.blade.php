@extends('account')

@section('title', 'Home')

@section('content')

<div class="card border-0 p-4 mt-4">
    <div class="text-center">
        <h4>CHOOSE PAYMENT METHOD BELOW</h4>
    </div>

    <form class="px-5" action="" method="post">
        <div class="row my-3">
            <div class="col-12 col-lg-3">
                <img src="{{ asset('img/airtel-money.png') }}" class="w-100" alt="">
            </div>
            <div class="col-12 col-lg-3">
                <img src="{{ asset('img/tigo-pesa.png') }}" class="w-100" alt="">
            </div>
            <div class="col-12 col-lg-3">
                <img src="{{ asset('img/m-pesa.png') }}" class="w-100" alt="">
            </div>
            <div class="col-12 col-lg-3">
                <img src="{{ asset('img/placeholder.png') }}" class="w-100" alt="">
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <h4 class="mt-2 mb-4">Make a payment</h4>
                <div class="text-light">
                    <span>Ref: 23033</span>
                    <span>Amount: TZS 25,000</span>
                </div>
                <div class="list-group list-group-flush text-light w-75">
                    <div class="list-group-item px-0 py-0"># Dial *150*00# for M-Pesa</div>
                    <div class="list-group-item px-0 py-0"># Dial *150*03# for TigoPesa</div>
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
                        <span>Amount: TZS 25,000</span>
                    </div>
                </div>

                <div class="custom-control custom-checkbox my-3">
                    <input type="checkbox" class="custom-control-input" id="customCheckDisabled1" disabled>
                    <label class="custom-control-label" for="customCheckDisabled1">I confirm payment</label>
                </div>

                <button type="submit" class="btn btn-primary my-1 ">Complete</button>
            </div>
        </div>
    </form>
</div>

@endsection
