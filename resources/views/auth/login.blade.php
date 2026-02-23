@extends('website')

@section('title', 'Log in')
@section('page-title','Log in')

@section('content')
<div class="clearfix p-3 p-lg-5">
    <div class="container section-padding text-center">
        <h5 class="text-center mb-4">Log in to your account</h5>
        <form class="w-lg-40 m-auto" style="max-width:400px;" action="<?= url('login');?>" method="POST">
            {{ csrf_field() }}
            @include('auth.alert')

            <!-- <div class="form-group">
                <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-2"></i> {{ Helper::trans('auth.use_facebook', 'Use facebook') }}</a>
            </div> -->

            <div class="form-group">
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn px-3"><i class="fa fa-envelope"></i></div>
                    </span>
                    <input name="username" type="text" class="form-control border-0" value="<?= old('username');?>" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group border rounded">
                    <span class="input-group-prepend text-light">
                        <div class="btn px-3"><i class="fa fa-key"></i></div> 
                    </span>
                    <input name="password" type="password" class="form-control border-0" placeholder="Password"/>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox text-left">
                    <input type="checkbox" name="remember_token" class="custom-control-input" id="remember_token">
                    <label class="custom-control-label pt-1" for="remember_token">Remember me.</label>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Log in</button>
                    </div>
                </div>
            </div>

            <div class="form-group d-flex align-items-center justify-content-between mb-0 ">
                <a href="<?= url('/password/reset');?>" class="text-dark">Forget your password?</a>
                <a href="<?= url('register');?>" class="text-dark">Register now</a>
            </div>
        </form>
    </div>
</div>


@endsection           