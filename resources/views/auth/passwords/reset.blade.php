@extends('website')

@section('title', "Reset")
@section('page-title', "Reset")

@section('content')

<div class="clearfix p-3 p-lg-5">
    <div class="container section-padding text-center">
        <h5 class="text-center mb-4">Reset your password</h5>
        <form class="w-lg-40 m-auto" style="max-width:400px;" action="{{ route('store_new_password') }}" method="POST">
             @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn"><i class="fa fa-envelope"></i></div>
                    </span>
                    <input name="email" type="email" class="form-control border-0" value="{{ $email }}" placeholder="E-mail Address">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn"><i class="fa fa-lock"></i></div>
                    </span>
                    <input type="password" class="form-control border-0" name="password" placeholder="Password">
                </div>
            </div>

            {{-- <div class="form-group">
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn"><i class="fa fa-lock"></i></div> 
                    </span>
                    <input type="password" class="form-control border-0" name="password_confirmation" placeholder="Password Confirmation">
                </div>
                @if(!empty($errors->first()))
                <div class="text-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
            </div> --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Reset</button>
            </div>
            </form>
            <div class="form-group d-flex align-items-center justify-content-between mb-0">
                
            </div>
        
    </div>
</div>


@endsection           