@extends('account')

@section('title', 'Home')

@section('content')

<div class="card border-0 p-4 mt-4">
    <div class="text-center">
        <h4>TOP UP YOUR CREDITS</h4>
        <h5 class="text-light">Your current credits: 0</h5>
    </div>

    <form action="{{ url('/account/credit/topup-complete') }}" method="get">

        <!----- Start form field amount ----->
        <div class="form-group">
            <input type="number" class="form-control {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ old('amount') }}" placeholder="Enter your amount" id="_input_amount">
            <div class="invalid-feedback" id="_input_help_amount">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
        </div>
        <!----- End form field amount ----->


        <button type="submit" class="btn btn-primary my-1 ">Continue Payment</button>
    </form>
</div>

@endsection
