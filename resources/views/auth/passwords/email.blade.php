@extends('website')

@section('title', "Email")
@section('page-title', "Email")

@section('content')
@include('auth.alert')
<div class="clearfix p-3 p-lg-5">
    <div class="container section-padding text-center">
        <h5 class="text-center mb-4">Enter your email</h5>
        
        <form class="w-lg-40 m-auto" style="max-width:400px;" action="<?= url('password/email');?>" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                @if(!empty($errors->first()))
                <div class="input-group text-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn"><i class="fa fa-envelope"></i></div>
                    </span>
                    <input name="email" type="email" class="form-control border-0" value="<?= old('email');?>" placeholder="E-mail Address">
                </div>
                @if(!empty($errors->first()))
                <div class="text-danger">
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Send email</button>
            </div>
            <div class="form-group d-flex align-items-center justify-content-between mb-0">
                <a class="text-dark" href="<?= url('login')?>">Back to login</a>
            </div>
        </form>
    </div>
</div>


@endsection           