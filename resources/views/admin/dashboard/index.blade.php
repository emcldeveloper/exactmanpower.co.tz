@extends('admin')

@section('title', 'Dashboard')

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">Dashboard</span>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">
            <div class="">
                {!! \App\Handlers\Admin\Dashboard\IndexContentHandler::handler(request(), false) !!}
            </div>
        </div>
    </div>
</div>


@endsection
