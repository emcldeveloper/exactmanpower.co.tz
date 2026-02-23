@extends('admin')

@section('title', Str::title(request('post_type_id')))

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3"> 
            <span class="h5 m-0">{{ Str::title(request('post_type_id')) }} list</span>
            <div>
                <a href="{{ url('admin/posts/'.request('post_type_id').'/create') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add new</a>
                <a href="{{ url('admin/posts/'.request('post_type_id').'/view_list_changed') }}" class="btn btn-outline-dark"><i class="fas fa-list mr-1"></i> 
                    <?php 
                        $var = \App\Models\PostViewType::where('user_id', Auth::user()->id)->latest()->first();
                     ?>
                     {{\App\Models\PostViewType::where('user_id', Auth::user()->id)->latest()->first()->status == 1 ? "Grid" : 'List'}}
                 </a>
                    

            </div>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">
            {!! \App\Handlers\Admin\Post\Post\IndexTableHandler::handler(request(), request('post_type_id'), false) !!}
        </div>
    </div>
</div>


@endsection
