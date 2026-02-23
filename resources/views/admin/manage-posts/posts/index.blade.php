@extends('admin')

@section('title', 'Posts')

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">{{ $title }} list (<span class="font-weight-bold">{{ (request('status'))? Str::title(request('status')): 'Waiting Approval' }}</span>)</span>
            <div>
                <a href="{{ url($route_create) }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container-detail bg-white">
        <div class="clearfix">
            <div class="">
                {!! \App\Handlers\Admin\ManagePost\Post\IndexTableHandler::handler(request(), false) !!}
            </div>
        </div>
    </div>
</div>


@endsection
