@extends('account')

@section('title', 'Account')

@section('content')

@include('accounts.accounts.navigation')

<div class="card border-0 p-4">
    <form action="{{ url('account/setting/account') }}" method="post" class="w-75">
        {{ csrf_field() }}
        <a href="{{ url('') }}" class="btn btn-primary btn-block mb-3">Disconnect your Facebook account</a>
        <!----- Start form field phone ----->
        <div class="form-group">
            <label class="mb-1" for="phone">Phone Number</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <div class="input-group-text">Number</div>
                </div>
                <input type="text" name="phone" class="form-control {{ $errors->has('phone')? 'is-invalid': null }}" value="{{ $account_model->phone }}" id="inlineFormInputGroup" placeholder="Phone">
            </div>
            <div class="invalid-feedback" id="_input_help_phone">{{ $errors->has('phone')? $errors->first('phone'): null }}</div>
        </div>
        <!----- End form field phone ----->

        <!----- Start form field whatsapp_number ----->
        <div class="form-group">
            <label class="mb-1" for="whatsapp_number">Whatsapp Number</label>
            <div class="input-group ">
                <div class="input-group-prepend">
                    <div class="input-group-text">Number</div>
                </div>
                <input type="text" name="whatsapp_number" class="form-control {{ $errors->has('whatsapp_number')? 'is-invalid': null }}" value="{{ $account_model->whatsapp_number }}" placeholder="Whatsapp number">
            </div>
            <div class="invalid-feedback" id="_input_help_whatsapp_number">{{ $errors->has('whatsapp_number')? $errors->first('whatsapp_number'): null }}</div>
        </div>
        <!----- End form field whatsapp_number ----->

        <!----- Start form field email ----->
        <div class="form-group">
            <label class="mb-1" for="email">Verified Email</label>
            <input type="text" class="form-control {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ $account_model->email }}" placeholder="Enter your email" id="_input_email">
            <div class="invalid-feedback" id="_input_help_email">{{ $errors->has('email')? $errors->first('email'): null }}</div>
        </div>
        <!----- End form field email ----->


        <button type="submit" class="btn btn-light btn-block my-1 ">Update Email</button>
    </form>  
</div>

@endsection
