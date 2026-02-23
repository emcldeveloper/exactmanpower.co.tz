@extends('admin')

@section('title', 'User Logs')

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">User Logs list</span>
            <div>
                <a href="{{ url('admin/manage-users/user-logs/create') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">
            {!! \App\Handlers\Admin\ManageUser\UserLog\IndexTableHandler::handler(request(), false) !!}
        </div>
    </div>
</div>


@endsection
